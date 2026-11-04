<?php

// Vercel only allows writes to /tmp; prepare writable storage folders before booting Laravel.
if (getenv('VERCEL') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $storagePath = '/tmp/storage';

    foreach ([
        $storagePath,
        $storagePath . '/framework',
        $storagePath . '/framework/cache',
        $storagePath . '/framework/cache/data',
        $storagePath . '/framework/sessions',
        $storagePath . '/framework/views',
        $storagePath . '/logs',
    ] as $directory) {
        if (! is_dir($directory)) {
            mkdir($directory, 0775, true);
        }
    }
}

require __DIR__ . '/../public/index.php';
