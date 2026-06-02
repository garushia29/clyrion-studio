<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
echo "1: bootstrap OK\n";

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
echo "2: kernel OK\n";

$request = Illuminate\Http\Request::create('http://localhost/up', 'GET');

try {
    $response = $kernel->handle($request);
    echo "3: response: " . $response->getStatusCode() . "\n";
} catch (Exception $e) {
    echo "3: ERROR: " . get_class($e) . ": " . $e->getMessage() . "\n";
}
