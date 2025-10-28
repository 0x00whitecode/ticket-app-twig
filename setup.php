<?php
/**
 * Setup script for ticket-app-twig
 * Run this to create necessary directories
 */

$dirs = [
    __DIR__ . '/cache',
    __DIR__ . '/data',
    __DIR__ . '/assets',
    __DIR__ . '/vendor'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "Created directory: $dir\n";
    } else {
        echo "Directory exists: $dir\n";
    }
}

echo "\nSetup complete!\n";
echo "Please run 'composer install' to install dependencies.\n";

