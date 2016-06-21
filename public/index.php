<?php

/**
 *  Front controller
 *
 *  PHP version 5.5.9
 */

/**
 *  Twig
 */
require_once dirname(__DIR__) . '/vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 *  Autoloader
 */
spl_autoload_register(function($class) {
    $root = dirname(__DIR__); // Get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

/**
 *  Error and Exception handling
 */
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 *  Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
//$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

// Display the routing table
//echo '<pre>';
//var_dump($router->getRoutes());
//echo '</pre>';

// Match the requested route
//$url = $_SERVER['QUERY_STRING'];

//if($router->match($url)) {
//    var_dump($router->getParams());
//} else {
//    echo 'No route found for URL "' . $url . '"';
//}

$router->dispatch($_SERVER['QUERY_STRING']);
