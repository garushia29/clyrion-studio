<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$routes = Illuminate\Support\Facades\Route::getRoutes();
foreach ($routes->getRoutes() as $r) {
    if ($r->uri() === 'admin/dashboard' || $r->uri() === 'admin/projects') {
        echo $r->getName() . ' -> ' . $r->uri() . ' -> methods: ' . implode(',', $r->methods()) . "\n";
    }
}
if (!Illuminate\Support\Facades\Route::has('admin.dashboard')) {
    echo "admin.dashboard NOT FOUND\n";
}
if (!Illuminate\Support\Facades\Route::has('admin.projects.index')) {
    echo "admin.projects.index NOT FOUND\n";
}
echo "Done.\n";
