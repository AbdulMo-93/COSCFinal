<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('APPS', ROOT . DS . 'app');
define('CORE', ROOT . DS . 'core');

//User define
define('HOME', '/129640100/public/');
define('REGISTER', HOME . 'usercontroller/add');
define('USER_DELETE', HOME . 'usercontroller/delete');
define('USER_LOGIN', HOME . 'usercontroller/login');
define('LOGIN', HOME . 'home/login');
define('LOGOUT', HOME . 'usercontroller/logout');
define('USER_ADD', HOME . 'usercontroller/add');
define('REPORT', HOME . 'usercontroller/report');
define('PHONE_LIST', HOME . 'usercontroller/phoneList');
define('MANAGE_CLIENT', HOME . 'usercontroller/manageClient');

//Client part
define('CLIENT_ADD',    HOME . 'usercontroller/addClient');
define('CLIENT_EDIT',   HOME . 'usercontroller/editClient');
define('CLIENT_UPDATE', HOME . 'usercontroller/updateClient');

// Reminder
define('REMINDER', HOME . 'remind/index');
define('REMINDER_SAVE', HOME . 'remind/save');
define('REMINDER_DELETE', HOME . 'remind/remove');

//REPORT
define('REMINDER_REPORT', HOME . DS . 'reports/attempts');

//Database info
define('DB_HOST'    , '127.0.0.1');
define('DB_USER'    , 'root');
define('DB_PASS'    , '');
define('DB_DATABASE', '129640100');
define('DB_PORT'    , '3306');