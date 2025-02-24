<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//auth routes.
$route['register'] = 'auth/register';
$route['login'] = 'auth/login';

//dashboards routes.
$route['admin'] = 'dashboards/index';


//categories routes.
$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/edit/(:any)'] = 'categories/update/$1';
$route['categories/delete/(:any)'] = 'categories/delete/$1';

//products routes.
$route['products'] = 'products/index';
$route['products/create'] = 'products/create';
$route['products/update/(:any)'] = 'products/update/$1';
$route['products/delete/(:any)'] = 'products/delete/$1';
$route['products/(:any)'] = 'products/show/$1';

//inventory routes.
$route['inventory'] = 'inventory/index';
$route['inventory/movements/(:any)'] = 'inventory/movements/$1';
$route['inventory/add/(:any)'] = 'inventory/add_movement/$1';

$route['producto/(:num)'] = 'pages/product_detail/$1';


//clients routes.
$route['clients'] = 'clients/index';
$route['clients/create'] = 'clients/create';
$route['clients/update/(:any)'] = 'clients/update/$1';
$route['clients/delete/(:any)'] = 'clients/delete/$1';
$route['clients/(:any)'] = 'clients/show/$1';

//messages routes.
$route['messages'] = 'messages/index';
$route['messages/(:any)'] = 'messages/view/$1';




//users routes.
$route['users'] = 'users/index';
$route['users/create'] = 'users/create';
$route['users/update/(:any)'] = 'users/update/$1';
$route['users/delete/(:any)'] = 'users/delete/$1';
$route['users/signature/(:any)'] = 'users/signature/$1';


//reports routes.
$route['reports'] = 'reports/index';


//default routes.
$route['(:any)'] = 'pages/view/$1';
//$route['(:any)'] = 'dashboards/index';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
