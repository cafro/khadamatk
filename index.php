<?php

require 'vendor/autoload.php';
$configs = include('config.php');
$mongoClient = new \MongoClient(); // legacy class!


$router = new AltoRouter();
$router->setBasePath('');
$router->addMatchTypes([
	'slug' => '[0-9A-Za-z_-]++'
  ]);


$router->map( 'GET|POST', '/', function() {
	require __DIR__ . '/views/home.php';
});


$router->map( 'GET', '/blog/[i:id]', function( $id ) {
	require __DIR__ . '/views/post.php';
});


$router->map( 'GET', '/blog/[i:id]/[slug:postslug]', function( $id, $postslug = NULL ) {
	require __DIR__ . '/views/post.php';
});


// $router->map( 'GET', '/about', function() {
// 	require __DIR__ . 'views/about.php';
// });

// $router->map( 'GET', '/blog', function() {
// 	require __DIR__ . 'views/blog.php';
// });

$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
    require 'views/404.html';
    // header("HTTP/1.0 404 Not Found");
	// header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
