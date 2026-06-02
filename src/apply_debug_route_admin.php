<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$routes = Illuminate\Support\Facades\Route::getRoutes();
foreach ($routes->getRoutes() as $r) {
    if (str_contains($r->getName() ?? '', 'admin')) {
        echo $r->getName() . ' -> ' . $r->uri() . "\n";
    }
}
