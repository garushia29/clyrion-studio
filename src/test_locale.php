<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('http://localhost', 'GET');
$response = $kernel->handle($request);
echo 'Locale: ' . app()->getLocale() . PHP_EOL;
$kernel->terminate($request, $response);
