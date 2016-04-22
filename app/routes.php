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
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
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
    $article = $app['dao.article']->find($id);
    return $app['twig']->render('article.html.twig', array('article' => $article));
})->bind('article');


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

/*
$app->error(function (\Exception $e, $code) {
    return new Response('We are sorry, but something went terribly wrong.'.$code);
});

$app->get('/error', function () use ($app) {
    return $app['twig']->render('error.html.twig');
})->bind('error');
*/