<?php

$uri = $_SERVER['REQUEST_URI'];

// remove query string
$uri = strtok($uri, '?');

if ($uri === '/receive.php') {
    require __DIR__ . '/receive.php';
    return;
}

// fallback test
echo "OK";