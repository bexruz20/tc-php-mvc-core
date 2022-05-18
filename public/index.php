<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;



require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
function dd($data)
{
    echo "<pre>";
    print_r($data);
    die;
}

// $app = new Application(dirname(__DIR__), $config);

$app = new Application(dirname(__DIR__),$config);



$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'Contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);


$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);


$app->run();
