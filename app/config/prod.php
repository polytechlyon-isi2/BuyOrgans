<?php


// Doctrine (db)

$app['db.options'] = array(

    'driver'   => 'pdo_mysql',

    'charset'  => 'utf8',

    'host'     => 'localhost',

    'port'     => '3306',

    'dbname'   => 'buyorgans',

    'user'     => 'buyorgans_user',

    'password' => 'secret',

);