<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 			= "dashboard";
$route['profile/register']				= "profile";
$route['register/profile']				= "profile/insert";
$route['login']							= "login";
$route['logout']						= "login/logout";
// $route['myprofile']						= "User/myprofile";


$route['movies']						= "movie";
$route['movies/page']					= "movie";
$route['movies/page/(:num)']			= "movie";
$route['movie/insert']					= "movie/insert";
$route['movie/update-info/(:any)']		= "movie/infoUpdate";
$route['movie/update/(:any)']			= "movie/update";
$route['movies/ajaxdirectors']			= "movie/ajaxdirectors";
$route['movies/poster']					= "movie/poster";
$route['movie/profile']					= "movie/profile";
$route['movie/profile/(:any)']			= "movie/profile";
$route['movies/approval']				= "movie/approval";
$route['movies/approval/page']			= "movie/approval";
$route['movies/approval/page/(:num)']	= "movie/approval";
$route['profile/myprofile']				= "profile/myprofile";
$route['profile/update']				= "profile/update";




$route['movie/approval-confirm']		= "movie/approvalConfirm";
$route['movie/remove/(:any)']			= "movie/remove";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */