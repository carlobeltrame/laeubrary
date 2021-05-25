<?php

use Illuminate\Contracts\Console\Kernel;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

echo 'Creating the storage link...<br>';
$kernel->call('storage:link');

echo 'Migrating the database...<br>';
$kernel->call('migrate', ['--force' => true]);

echo 'Removing the post-deploy script... Bye bye<br>';
unlink(__FILE__);
