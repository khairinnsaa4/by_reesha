<?php

// Suppress deprecation warnings and disable displaying raw errors to HTTP output
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Forward Vercel requests to normal Laravel public/index.php
require __DIR__ . '/../public/index.php';
