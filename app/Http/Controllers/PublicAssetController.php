<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Mime\MimeTypes;

class PublicAssetController extends Controller
{
    private const MIME_TYPES = [
        'css' => 'text/css; charset=utf-8',
        'js' => 'text/javascript; charset=utf-8',
        'mjs' => 'text/javascript; charset=utf-8',
        'json' => 'application/json; charset=utf-8',
        'map' => 'application/json; charset=utf-8',
        'txt' => 'text/plain; charset=utf-8',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'avif' => 'image/avif',
        'ico' => 'image/x-icon',
        'pdf' => 'application/pdf',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
    ];

    public function build(string $path): BinaryFileResponse
    {
        return $this->serve('build/'.$path, 'public, max-age=31536000, immutable');
    }

    public function images(string $path): BinaryFileResponse
    {
        return $this->serve('images/'.$path, 'public, max-age=604800');
    }

    public function files(string $path): BinaryFileResponse
    {
        return $this->serve('files/'.$path, 'public, max-age=604800');
    }

    public function favicon(): BinaryFileResponse
    {
        return $this->serve('favicon.ico', 'public, max-age=604800');
    }

    public function robots(): BinaryFileResponse
    {
        return $this->serve('robots.txt', 'public, max-age=3600');
    }

    private function serve(string $relativePath, string $cacheControl): BinaryFileResponse
    {
        $basePath = realpath(public_path());
        $filePath = realpath(public_path($relativePath));

        abort_unless(
            $basePath !== false
            && $filePath !== false
            && str_starts_with($filePath, $basePath.DIRECTORY_SEPARATOR)
            && is_file($filePath),
            404
        );

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $contentType = self::MIME_TYPES[$extension]
            ?? MimeTypes::getDefault()->getMimeTypes($extension)[0]
            ?? 'application/octet-stream';

        return response()->file($filePath, [
            'Content-Type' => $contentType,
            'Cache-Control' => $cacheControl,
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
