<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = ''; 
$route['updates/(:any)'] = 'updates/index/$1/';  
$route['updates/(:any)/(:any)'] = 'updates/view_details/$1/$2'; 
$route['updates/category/(:any)/(:any)/(:any)'] = 'updates/category/$1/$2/$3';
$route['college/(:any)/(:any)'] = 'search/college_details/$1/$2';
$route['course/(:any)/(:any)'] = 'search/course_details/$1/$2';
$route['forums/(:any)'] = 'forums/index/$1'; 
$route['forums/(:any)/(:any)'] = 'forums/view_forum_answers/$1/$2';
$route['ask-forums'] = 'ask_forums/index/';
$route['top-college/(:any)'] = 'top_college/index/$1/';
$route['top-college'] = 'top_college';
$route['latest-update'] = 'latest_update';
$route['privacy-policy/(:any)'] = 'Privacy_policy/index/$1/';
$route['privacy-policy'] = 'Privacy_policy';
$route['translate_uri_dashes'] = FALSE;
