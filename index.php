<?php
if(!isset($_SESSION)) session_start();
require 'vendor/autoload.php';

// Polyfill for Unsupported is_countable (< PHP 5.6)
if (!function_exists('is_countable')) {
    function is_countable($var) {
        return (is_array($var) || $var instanceof Countable);
    }
}

// Initialise Settings
$app = new \Slim\Slim(
    array(
        'debug' => true,
        'templates.path' => './views'
    )
);

// Globals
//$_SESSION['asset'] = 'http://localhost/poll';
$_SESSION['asset'] = 'https://holy.uccabs.live';
//$app->db = require_once './config/db.php';

// Route Handlers
require 'routes/auth.php';
require 'routes/main.php';

// Error Handlers
$app->error(function (\Exception $e) use ($app) {
   $app->render('error.php');
});
$app->error(function (\Exception $e) use ($app) {
   $app->render('error.php');
});
$app->notFound(function () use ($app) {
   $app->render('404.html');
});


$app->run();

                






