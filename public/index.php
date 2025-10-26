<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Bramus\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Set error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize Twig
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, [
    'cache' => false, // Disable cache in production
    'debug' => false  // Disable debug in production
]);

// Initialize Router
$router = new Router();

require_once __DIR__ . '/../src/Auth.php';

// No server-side auth check - we're using client-side localStorage check
$router->before('GET|POST', '/dashboard.*', function() {
    // Allow all requests to dashboard, client-side JS will handle auth
    return;
});

// Routes
$router->get('/', function() use ($twig) {
    echo $twig->render('landing.twig');
});

$router->get('/auth/login', function() use ($twig) {
    $errors = [];
    echo $twig->render('/auth/login.twig', ['errors' => $errors]);
});

$router->post('/auth/login', function() use ($twig) {
    // Get JSON data from request body
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    
    try {
        $session = Auth::login($email, $password);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $session
        ]);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
});

$router->get('/auth/signup', function() use ($twig) {
    $errors = [];
    echo $twig->render('/auth/signup.twig', [
        'errors' => $errors,
        'old' => []
    ]);
});

$router->post('/auth/signup', function() use ($twig) {
    // Get JSON data from request body
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    
    try {
        $session = Auth::signup($name, $email, $password);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $session
        ]);
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
});

$router->get('/dashboard', function() use ($twig) {
    echo $twig->render('dashboard.twig');
});

$router->get('/tickets', function() use ($twig) {
    echo $twig->render('tickets/index.twig');
});

$router->post('/auth/logout', function() {
    $response = Auth::logout();
    header('Content-Type: application/json');
    echo json_encode($response);
});

$router->run();
