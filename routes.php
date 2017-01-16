<?php

function call($controller, $action)
{
    require_once 'controllers/' . $controller . '_controller.php';
    require_once 'models/statistics.php';
    switch ($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'users':
            require_once 'models/user.php';
            $controller = new UsersController();
            break;
        case 'events':
            require_once 'models/user.php';
            require_once 'models/event.php';
            require_once 'models/attendee.php';
            $controller = new EventsController();
            break;
        case 'attendees':
            require_once 'models/event.php';
            require_once 'models/attendee.php';
            $controller = new AttendeesController();
            break;
        case 'presentations':
            require_once 'models/event.php';
            require_once 'models/presentation.php';
            $controller = new PresentationsController();
    }
    $controller->{$action}();
    if ($_SERVER['REQUEST_URI'] != '/assets/css/bootstrap.min.css.map') {
        Statistics::insert_or_update($_SERVER['REQUEST_URI']);
    }
}

$controllers = array(
    'pages' => ['home', 'contact', 'tweets', 'stats', 'error'],
    'users' => ['index', 'create', 'update', 'profile', 'login', 'logout'],
    'events' => ['index', 'show', 'admin', 'create', 'update'],
    'attendees' => ['show', 'create', 'export'],
    'presentations' => ['update'],
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}
