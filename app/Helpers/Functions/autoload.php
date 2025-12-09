<?php

foreach (scandir(__DIR__) as $filename) {
    if (pathinfo($filename, PATHINFO_EXTENSION) === 'php' && $filename !== 'autoload.php') {
        require_once __DIR__ . '/' . $filename;
    }
}
