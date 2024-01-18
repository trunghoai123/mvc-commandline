<?php
$routes['default_controller'] = 'Home';
$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';
// $routes = [
//     'home' => [
//         'controller' => 'Home',
//         'action' => 'index'
//     ],
//     'home/detail' => [
//         'controller' => 'Home',
//         'action' => 'detail'
//     ],
//     'product' => [
//         'controller' => 'Product',
//         'action' => 'index'
//     ],
//     'product/detail' => [
//         'controller' => 'Product',
//         'action' => 'detail'
//     ]
// ];
