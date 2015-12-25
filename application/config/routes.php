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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'post';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "post" class
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['nha-(:num)'] = 'post/sort/$1';

$route['dang-tin'] = 'post/create_post';
require_once( BASEPATH .'database/DB.php' );
$db =& DB();
$query = $db->get( MODEL_POST_CATEGORY );
$result = $query->result_array();
foreach( $result as $row ) {
    $route[ 'dang-tin-'.$row['url_name'] ] = 'post/create_'.$row['link'];
}

$route['dang-ki'] = 'user/register';
$route['quen-mat-khau'] = 'user/forgot_password';
$route['dang-nhap'] = 'user/login';
$route['dang-xuat'] = 'user/logout';
$route['contact'] = 'user/contact';
$route['tai-khoan'] = 'user/dashboard';

$route['dang-tin'] = 'post/create_post';
$route['loai-(:num)'] = 'post/show_by_category/1/$1/1';
$route['loai-(:num)-(:num)'] = 'post/show_by_category/$2/$1/1';
$route['loai-(:num)-moinhat'] = 'post/show_by_category/1/$1/1';
$route['loai-(:num)-gia-tang'] = 'post/show_by_category/1/$1/2';
$route['loai-(:num)-gia-giam'] = 'post/show_by_category/1/$1/3';
$route['loai-(:num)-dientich-tang'] = 'post/show_by_category/1/$1/4';
$route['loai-(:num)-dientich-giam'] = 'post/show_by_category/1/$1/5';
$route['loai-(:num)-moinhat-(:num)'] = 'post/show_by_category/$2/$1/1';
$route['loai-(:num)-gia-tang-(:num)'] = 'post/show_by_category/$2/$1/2';
$route['loai-(:num)-gia-giam-(:num)'] = 'post/show_by_category/$2/$1/3';
$route['loai-(:num)-dientich-tang-(:num)'] = 'post/show_by_category/$2/$1/4';
$route['loai-(:num)-dientich-giam-(:num)'] = 'post/show_by_category/$2/$1/5';
$query = $db->get( MODEL_DISTRICT );
$result = $query->result_array();
foreach( $result as $row ) {
    $route[ 'nha-tro-'.$row['tenkhac'] ] = 'post/show_by_district/1/'.$row['idQ'];
    $route[ 'nha-tro-'.$row['tenkhac'].'/(:num)' ] = 'post/show_by_district/$1/'.$row['idQ'];
}

$route['home'] = 'post/get_all';
$route['home/(:num)'] = 'post/get_all/$1';
$route['tin-(:num)'] = 'post/index/$1';
$route['(:num)'] = 'post/index/$1';
$route['filter-(:num)'] = 'filter/filter/$1';

$route['buon-ban'] = 'market/create';
$route['tin-vat'] = 'market/get_all';
$route['tin-vat-(:num)'] = 'market/get_all/$1';
$route['(:num)-tin-vat'] = 'market/index/$1';
$route['rao-vat-(:num)'] = 'market/get_by_category/1/$1';
$route['(:num)-rao-vat-(:num)'] = 'market/get_by_category/$2/$1';
