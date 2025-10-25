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
    'cache' => __DIR__ . '/../cache',
    'auto_reload' => true,
    'debug' => true
]);

// Initialize Router
$router = new Router();

// Middleware to check authentication
$router->before('GET|POST', '/dashboard.*', function() {
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
});

// Routes
$router->get('/', function() use ($twig) {
    echo $twig->render('landing.twig');
});

$router->get('/login', function() use ($twig) {
    $errors = [];
    echo $twig->render('login.twig', ['errors' => $errors]);
});

$router->post('/login', function() use ($twig) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rememberMe = isset($_POST['remember-me']);
    
    $errors = [];
    
    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }
    
    if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }
    
    if (!empty($errors)) {
        echo $twig->render('login.twig', ['errors' => $errors]);
        return;
    }
    
    // TODO: Implement actual authentication
    $_SESSION['user'] = ['email' => $email];
    
    // Redirect to dashboard
    header('Location: /dashboard');
    exit();
});

$router->get('/signup', function() use ($twig) {
    $errors = [];
    echo $twig->render('signup.twig', [
        'errors' => $errors,
        'old' => []
    ]);
});

$router->post('/signup', function() use ($twig) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    
    $errors = [];
    $old = [
        'name' => $name,
        'email' => $email
    ];
    
    // Validation matching the React zod schema
    if (strlen($name) < 2) {
        $errors['name'] = 'Name must be at least 2 characters';
    } else if (strlen($name) > 50) {
        $errors['name'] = 'Name cannot exceed 50 characters';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }
    
    if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } else if (strlen($password) > 100) {
        $errors['password'] = 'Password cannot exceed 100 characters';
    }
    
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Passwords don't match";
    }
    
    if (!empty($errors)) {
        echo $twig->render('signup.twig', [
            'errors' => $errors,
            'old' => $old
        ]);
        return;
    }
    
    // TODO: Implement actual user creation
    
    // Redirect to login page
    header('Location: /login');
    exit();
});

$router->get('/dashboard', function() use ($twig) {
    echo $twig->render('dashboard.twig');
});

$router->get('/tickets', function() use ($twig) {
    echo $twig->render('tickets/index.twig');
});

$router->run();
