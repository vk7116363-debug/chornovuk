<?php

header('Content-Type: application/json; charset=utf-8');

$googleUrl = 'https://script.google.com/macros/s/AKfycbwm0phyEI6AM6Yetd-R7PlCtyN-q4BQJRVkZQz-VKyGInBhJ-DeXDzJNoZi3HtCbKd9/exec';

$cacheDir = __DIR__ . '/cache';

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

$cacheFile = $cacheDir . '/stock-cache.json';

$cacheTime = 300; // 5 хвилин

if (
    file_exists($cacheFile)
    && (time() - filemtime($cacheFile) < $cacheTime)
) {

    echo file_get_contents($cacheFile);
    exit;
}

$response = @file_get_contents($googleUrl);

if ($response !== false) {

    file_put_contents($cacheFile, $response);

    echo $response;
    exit;
}

if (file_exists($cacheFile)) {

    echo file_get_contents($cacheFile);
    exit;
}

echo json_encode([]);