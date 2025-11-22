<?php

// Hibák megjelenítése (csak hibakereséshez!)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ellenőrizzük, hogy a vendor mappa létezik-e
if (!file_exists(__DIR__.'/vendor/autoload.php')) {
    die("HIBA: A 'vendor' mappa hiányzik vagy üres! Futtasd a 'composer install'-t a gépeden és töltsd fel.");
}

// Megpróbáljuk betölteni a Laravelt
try {
    require __DIR__.'/public/index.php';
} catch (Throwable $e) {
    echo "<h1>Végzetes hiba történt:</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}