<?php
// 1) Získej čistou část cesty
$uri   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base  = '/u24';
$route = trim(substr($uri, strlen($base)), '/');

// 2) Vyber view
switch ($route) {
    case '':
    case 'home':
        $view = 'home';
        break;
    case 'knihovna':
        $view = 'knihovna';
        break;
    case 'admin':
        $view = 'admin';
        break;
    default:
        http_response_code(404);
        echo '404 - Stránka nenalezena';
        exit;
}

// 3) Připrav plnou cestu k šabloně stránky
$pageFile = __DIR__ . "/src/pages/{$view}.php";
if (!file_exists($pageFile)) {
    http_response_code(500);
    echo "Chyba: šablona '{$view}' neexistuje.";
    exit;
}

// 4) Vykresli layout a **předej** mu hotovou proměnnou $pageFile
include __DIR__ . '/src/layout/layout.php';