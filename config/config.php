<?php
// Podstawowa konfiguracja aplikacji
return [
    'db' => [
        // Sterownik: 'sqlite' lub 'mysql'
        'driver' => 'sqlite',

        // --- Ustawienia SQLite ---
        'path' => __DIR__ . '/../database/planaroo.sqlite',

        // --- Ustawienia MySQL (używane gdy driver = 'mysql') ---
        'host'     => 'localhost',
        'port'     => 3306,
        'dbname'   => 'projekty_firma',
        'username' => 'root',
        'password' => '',
        'charset'  => 'utf8mb4'
    ],
    'app' => [
        'name'     => 'Zarządzanie Projektami',
        'version'  => '1.0.0',
        'debug'    => true,
        'base_url' => 'http://localhost:8080/'
    ]
];