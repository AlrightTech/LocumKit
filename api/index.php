<?php

/**
 * Vercel Serverless Function Handler for Laravel
 * This file handles all incoming requests and routes them through Laravel
 */

define('LARAVEL_START', microtime(true));

// Get the project root directory (two levels up from api/)
$basePath = dirname(__DIR__);

// Register the Composer autoloader
require $basePath . '/vendor/autoload.php';

// Bootstrap the Laravel application
$app = require_once $basePath . '/bootstrap/app.php';

// Handle the incoming request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Send the response
$response->send();

// Terminate the kernel
$kernel->terminate($request, $response);




