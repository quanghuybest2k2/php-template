<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\routes\Web;
use App\utils\Logger;
use App\config\Env;

Env::loadEnv('.env');

// config access static files
$requestUri = $_SERVER['REQUEST_URI'];
if (preg_match('#^/public/(.+)$#', $requestUri, $matches)) {
    $filePath = __DIR__ . '/public/' . $matches[1];

    if (file_exists($filePath) && is_file($filePath)) {
        $mimeType = mime_content_type($filePath);
        header('Content-Type: ' . $mimeType);
        readfile($filePath);
        exit;
    } else {
        http_response_code(404);
        echo "File not found.";
        exit;
    }
}

try {
    $web_router = new Web();
    $web_router->handleRequest();
} catch (Exception $e) {
    // Log the error message
    Logger::error('Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
    $debug_mode = getenv('DEBUG_MODE');
    if ($debug_mode == 'true') {
        // Display the error message
        echo "<h1>Error: {$e->getMessage()}</h1>";
        echo "<pre>{$e->getTraceAsString()}</pre>";
    } else {
        // Display a generic error message
        http_response_code(500);
        echo "An error occurred. Please try again later.";
    }
    exit;
}
