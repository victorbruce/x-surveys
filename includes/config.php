<?php
$config = parse_ini_file('config.ini');

defined('DB_SERVER') ? NULL : define('DB_SERVER', $config['host']);
defined('DB_USER')   ? NULL : define('DB_USER', $config['username']);
defined('DB_PASS')   ? NULL : define('DB_PASS', $config['password']);
defined('DB_NAME')   ? NULL : define('DB_NAME', $config['db']);
?>