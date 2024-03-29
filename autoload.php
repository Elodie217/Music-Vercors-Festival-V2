<?php
spl_autoload_register(function ($className) {
    $fileName = str_replace('\\', '/', $className) . '.php';
    $filePath = __DIR__ . '/' . $fileName;
    try {
        if (file_exists($filePath)) {
            require_once $filePath;
        }
    } catch (Error $error) {
        echo "Une erreur est survenue : " . $error->getMessage();
    }
});
