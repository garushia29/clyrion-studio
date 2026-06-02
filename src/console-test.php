<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
echo "1: bootstrap OK\n";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
echo "2: kernel OK\n";
$status = $kernel->call('inspire');
echo "3: inspire status: $status\n";
