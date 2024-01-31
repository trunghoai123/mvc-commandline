<?php
define(
    'DIR_ROOT',
    __DIR__
);
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $webRoot = 'https://' . $_SERVER['HTTP_HOST']; //protocal + domain
} else {
    $webRoot = 'http://' . $_SERVER['HTTP_HOST'];
}
$folderName = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', DIR_ROOT));
$webRoot = $webRoot . $folderName;

define(
    '_WEB_ROOT',
    $webRoot
);

$configDirs = scandir('configs');

if (!empty($configDirs)) {
    foreach ($configDirs as $configDir) {
        if ($configDir != '.' && $configDir != '..' && file_exists('configs/' . $configDir)) {
            require_once('configs/' . $configDir);
        }
    }
}

require_once('core/Route.php');
require_once('app/App.php');

if (!empty($config['database'])) {
    $db_config = ($config['database']);

    if (!empty($db_config)) {
        require_once('core/Connection.php');
        require_once('core/QueryBuilder.php');
        require_once('core/Database.php');
        require_once('core/DB.php');
        // new Connection($db_config);
        // $conn = Connection::getInstance($db_config);
        // $db = new Database();

        // $rs = $db->query1();
        // $rs = $db->query('SELECT * FROM php_mvc.username')->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($rs);
        // echo '</pre>';
    }
}
require_once('core/Model.php');

require_once('core/Controller.php');

require_once('core/Request.php');
