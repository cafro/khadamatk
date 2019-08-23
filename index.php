<?php

require 'vendor/autoload.php';
$configs = include('config.php');

$router = new AltoRouter();
$router->setBasePath('');


$router->map( 'GET', '/', function() {
	require __DIR__ . '/views/home.php';
});

$router->map( 'POST', '/', function() {
	require __DIR__ . '/views/home.php';
});

$router->map( 'GET', '/about', function() {
	require __DIR__ . 'views/about.php';
});

$router->map( 'GET', '/blog', function() {
	require __DIR__ . 'views/blog.php';
});

$router->map( 'GET', '/blog/[i:id]', function( $id ) {
	require __DIR__ . '/views/post.php';
});


$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
    require 'views/404.html';
    // header("HTTP/1.0 404 Not Found");
	// header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
