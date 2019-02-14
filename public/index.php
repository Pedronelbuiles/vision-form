<?php
require '../vendor/autoload.php';


// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];
$app = new \Slim\App($config);

// Define app routes
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->write("Hello " . $args['name']);
});

//crear las rutas
require '../src/rutas/productos.php';

// Run app
$app->run();
