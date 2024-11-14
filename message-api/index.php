<?php

use Activities\Auth\Auth;
//
//session_start();
//security---------------------------------------------------------
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
ini_set('log_errors', 1);
session_set_cookie_params(0, '/', 'localhost', false, true);
//'cookie_secure' => isset($_SERVER['HTTPS']), this project use http
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => false,
    'use_strict_mode' => true,
    'use_only_cookies' => true
]);
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
} else if (time() - $_SESSION['created'] > 1800) { // after 30m
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}
//security---------------------------------------------------------

//autoload
spl_autoload_register(function ($className) {
    $path = BASE_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR;
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    include $path . $className . '.php';
});


//database required
require_once 'database/Database.php';

//require admin class
require_once 'activities/Admin/Admin.php';

//content
require_once 'activities/Admin/Content/Message.php';

//require Auth
require_once 'activities/Auth/Authentication.php';
require_once 'activities/Auth/Register.php';

//helpers
require_once 'helpers/helper.php';

//routing
require_once 'routes/web.php';
