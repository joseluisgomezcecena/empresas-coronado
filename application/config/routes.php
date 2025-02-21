<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//auth routes.
$route['register'] = 'auth/register';
$route['login'] = 'auth/login';

//admin routes.
$route['admin'] = 'dashboards/index';

$route['forms'] = 'form_builder/index';
$route['forms/create'] = 'form_builder/create';
$route['forms/edit/(:any)'] = 'form_builder/edit/$1';
$route['forms/delete/(:any)'] = 'form_builder/delete/$1';
$route['forms/preview/(:any)'] = 'forms/preview/$1';
$route['forms/fields/(:any)'] = 'forms/fields/$1';
$route['forms/fields/create/(:any)'] = 'forms/fields_create/$1';
$route['forms/fields/edit/(:any)'] = 'forms/fields_edit/$1';
$route['forms/fields/delete/(:any)'] = 'forms/fields_delete/$1';


//categories routes.
$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/edit/(:any)'] = 'categories/edit/$1';
$route['categories/delete/(:any)'] = 'categories/delete/$1';

//customfields routes.
$route['customfields'] = 'customs/index';
$route['customfields/create'] = 'customs/create';
$route['customfields/edit/(:any)'] = 'customs/edit/$1';
$route['customfields/delete/(:any)'] = 'customs/delete/$1';

//properties routes.
$route['properties'] = 'properties/index';
$route['properties/create'] = 'properties/create';
$route['properties/images/(:any)'] = 'properties/images/$1';
$route['properties/update/(:any)'] = 'properties/update/$1';
$route['properties/delete/(:any)'] = 'properties/delete/$1';
$route['properties/cover/(:any)'] = 'properties/cover/$1';
$route['properties/sold/(:any)'] = 'properties/sold/$1';



//clients routes.
$route['clients'] = 'clients/index';
$route['clients/create'] = 'clients/create';
$route['clients/update/(:any)'] = 'clients/update/$1';
$route['clients/delete/(:any)'] = 'clients/delete/$1';
$route['clients/(:any)'] = 'clients/show/$1';


//messages routes.
$route['messages'] = 'messages/index';
$route['messages/(:any)'] = 'messages/view/$1';


//operations routes.
$route['operations'] = 'operations/index';
$route['operations/create'] = 'operations/create';
$route['operations/update/(:any)'] = 'operations/update/$1';
$route['operations/delete/(:any)'] = 'operations/delete/$1';
$route['operations/(:any)'] = 'operations/show/$1';
$route['operations/customfields/(:any)'] = 'operations/customfields/$1';
    

//projects routes.
$route['projects'] = 'projects/index';
$route['projects/create'] = 'projects/create';
$route['projects/update/(:any)'] = 'projects/update/$1';
$route['projects/delete/(:any)'] = 'projects/delete/$1';
$route['projects/search'] = 'projects/search';
$route['projects/show/(:any)'] = 'projects/show/$1';
$route['projects/(:any)/operations'] = 'projects/operations/$1';
$route['projects/update_order'] = 'projects/update_order';



//workorders routes.
$route['workorders'] = 'workorders/index';
$route['workorders/update/(:any)'] = 'workorders/update/$1';
$route['workorders/print/(:any)'] = 'workorders/print/$1';
$route['workorders/print_template/(:any)'] = 'workorders/print_template/$1';


//users routes.
$route['users'] = 'users/index';
$route['users/create'] = 'users/create';
$route['users/update/(:any)'] = 'users/update/$1';
$route['users/delete/(:any)'] = 'users/delete/$1';
$route['users/signature/(:any)'] = 'users/signature/$1';


//reports routes.
$route['reports'] = 'reports/index';

$route['property_list/(:any)'] = 'pages/property_list/$1';
$route['search'] = 'pages/search';

$route['property/(:any)'] = 'pages/property_details/$1';

//default routes.
//$route['(:any)'] = 'pages/view/$1';
$route['(:any)'] = 'dashboards/index';
$route['default_controller'] = 'dashboards/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
