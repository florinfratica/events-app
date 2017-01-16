<?php

// fix for headers already sent warning
ob_start();
session_start();
$config_file = 'config.php';
if (file_exists($config_file)) {
    require_once 'config.php';
} else {
    die('Fișierul de configurare nu există.');
}
require_once 'connection.php';
require_once 'helpers/form_validation.php';
require_once 'helpers/url.php';

if (isset($_GET['page']) && isset($_GET['action'])) {
    $controller = $_GET['page'];
    $action = $_GET['action'];
} else {
    $controller = 'pages';
    $action = 'home';
}

if ($action == 'export') {
    require_once 'routes.php';
} else {
    require_once 'views/layouts/default.php';
}
ob_end_flush();
