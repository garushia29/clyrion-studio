<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$routes = Illuminate\Support\Facades\Route::getRoutes();
foreach ($routes->getRoutes() as $r) {
    echo ($r->getName() ?? 'UNNAMED') . "\n";
}
