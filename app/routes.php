<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BuyOrgans\Domain\User;
use BuyOrgans\Form\Type\UserType;

// Home page
$app->get('/', function () use ($app) {
	 $categories = $app['dao.categorie']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
})->bind('home');


// Articles list in a categorie
$app->get('/categorie/{id}', function ($id) use ($app) {
    $categorie = $app['dao.categorie']->find($id);
    try{
        $articles = $app['dao.article']->findByCategorie($id);
        return $app['twig']->render('categorie.html.twig', array('categorie' => $categorie, 'articles' => $articles));
    }
    catch(Exception $e){
         return $app['twig']->render('categorie.html.twig', array('categorie' => $categorie));
    }
    
})->bind('categorie');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Signup form
$app->get('/signup', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $user->setRole("ROLE_USER");
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', "Le compte a été créé.");
    }
    return $app['twig']->render('signup.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('signup')->method('POST|GET');

//view and modify profile
$app->get('/profile', function(Request $request) use ($app) {
    return $app['twig']->render('profile.html.twig');
})->bind('profile');

//Article details and coments
$app->get('/article/{id}', function ($id) use ($app) {
     try{
        $article = $app['dao.article']->find($id);
        return $app['twig']->render('article.html.twig', array('article' => $article));
    }catch(Exception $e){
        return $app['twig']->render('article.html.twig');
    }
    
})->bind('article');

// add Article to cart
$app->post('/article/{id}/', function ($id, Request $request) use ($app){
    try{
        $article = $app['dao.article']->find($id);
        if($request->get("addcart")){
            if($app['session']->has("cart")){
                $cart = $app['session']->get("cart");
                array_push($cart, $id);
                $app['session']->set("cart", $cart);
            }else{
                $cart = array($id);
                $app['session']->set("cart", $cart);
            }
             $app['session']->getFlashBag()->add('success', "L'article a été ajouté au panier.");
        }
        return $app['twig']->render('article.html.twig', array('article' => $article));
    }catch(Exception $e){
        return $app['twig']->render('article.html.twig');
    }
})->bind('addcart');

$app->get('/cart', function () use ($app) {
   
        if($app['session']->has('cart')){
            $articles = array();
            $total = 0;
            $cart = $app['session']->get('cart');
            foreach($cart as $key => $articleId){
                try{
                    $article = $app['dao.article']->find($articleId);
                    array_push($articles, $article);
                    $total += $article->getPrice();
                }catch(Exception $e){
                    unset($cart[$key]);
                    $app['session']->set('cart', $cart);
                }
            }
            if(empty($articles))
                return $app['twig']->render('cart.html.twig');
            else
                return $app['twig']->render('cart.html.twig', array('articles' => $articles, 'total' => $total));

        }
        else
            return $app['twig']->render('cart.html.twig');
})->bind('cart');

$app->get('/search/', function () use ($app) {
    $categories = $app['dao.categorie']->findAll();
    return $app['twig']->render('search.html.twig', array('categories' => $categories));
})->bind('search');

$app->post('/results/', function (Request $request) use ($app) {
    $catId = $request->get('categorie');
    $keyword = $request->get('keyword');
    try{
        if($catId == -1){
            $articles = $app['dao.article']->findKeyword($keyword);
        }else{
            $articles = $app['dao.article']->findKeywordByCategorie($keyword,$catId);
        }
        return $app['twig']->render('categorie.html.twig', array('articles' => $articles));
    }catch(Exception $e){
        return $app['twig']->render('categorie.html.twig');
    }
})->bind('results');


$app->get('/checkout', function () use ($app) {
    return $app['twig']->render('checkout.html.twig');
})->bind('checkout');


$app->error(function (\Exception $e, $code) use ($app){
    return $app['twig']->render('error.html.twig');
});

$app->get('/error', function () use ($app) {
    return $app['twig']->render('error.html.twig');
})->bind('error');
