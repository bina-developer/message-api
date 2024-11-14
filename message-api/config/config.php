<?php

//config
define('BASE_PATH', dirname(__DIR__));
define('DISPLAY_ERROR', true);
define('CURRENT_DOMAIN', trim(currentDomain(), '/') . '/message-api/');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_NAME', 'message');
define('DB_PASSWORD', '');