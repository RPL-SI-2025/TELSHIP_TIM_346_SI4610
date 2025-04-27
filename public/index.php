<?php
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Autoload dependencies
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
