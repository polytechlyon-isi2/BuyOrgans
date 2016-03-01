<?php


// Home page

$app->get('/', function () use ($app) {

	 $categories = $app['dao.categorie']->findAll();

    return $app['twig']->render('index.html.twig', array('categories' => $categories));

})->bind('home');


// Article details with comments

$app->get('/articles', function () use ($app) {

    $articles = $app['dao.article']->findAll();

    return $app['twig']->render('index.html.twig', array('articles' => $articles));

})->bind('articles');