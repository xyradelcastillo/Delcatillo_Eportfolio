<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

// Vercel only allows writes to /tmp; prepare writable storage folders before booting Laravel.
if (getenv('VERCEL') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $storagePath = '/tmp/storage';
    $bootstrapCachePath = '/tmp/bootstrap/cache';

    foreach ([
        $storagePath,
        $storagePath . '/framework',
        $storagePath . '/framework/cache',
        $storagePath . '/framework/cache/data',
        $storagePath . '/framework/sessions',
        $storagePath . '/framework/views',
        $storagePath . '/logs',
        $bootstrapCachePath,
    ] as $directory) {
        if (! is_dir($directory)) {
            mkdir($directory, 0775, true);
        }
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

if (getenv('VERCEL') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
}

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    error_log(sprintf(
        'Uncaught exception: %s in %s:%d',
        $e->getMessage(),
        $e->getFile(),
        $e->getLine()
    ));
    throw $e;
}
