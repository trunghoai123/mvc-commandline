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
require_once('configs/routes.php');
require_once('core/Route.php');
require_once('app/App.php');
require_once('core/Controller.php');
