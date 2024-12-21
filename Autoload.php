<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/src/' ;

    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $classPath = str_replace('_', DIRECTORY_SEPARATOR, $classPath);

    $filePath = $baseDir . $classPath . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});