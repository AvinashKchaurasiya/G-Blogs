<?php

use App\Controllers\Admin;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  frontend
$routes->get('/', 'Home::index');
$routes->get('/(:num)/(:segment)', 'Home::showDetails/$1/$2');
$routes->get('/category/(:num)/(:segment)', 'Home::showCategories/$1/$2');
$routes->get('/categoryBlogs/(:num)/(:segment)', 'Home::getCategoryBlogs/$1/$2');
$routes->get('/blogs', 'Home::blogs');
$routes->get('/login', 'Home::login');
// 404 page
// $routes->get('/(:any)', 'Home::index', ['as' => '404_page']);


// backend

$routes->get('/admin/dashboard','Admin::index');
$routes->get('/admin/blogs','Admin::blog');
$routes->get('/admin/addBlog','Admin::addBlog');
$routes->post('/admin/storeBlog', 'Admin::storeBlog');
$routes->get('/admin/editBlog/(:num)', 'Admin::addBlog/$1');
$routes->post('/admin/updateBlog/(:num)', 'Admin::storeBlog/$1');
$routes->get('/admin/changeStatus/(:num)', 'Admin::changeStatus/$1');
$routes->get('/admin/deleteBlog/(:num)', 'Admin::deleteBlog/$1');

$routes->get('/admin/category','Admin::Category');
$routes->get('/admin/addCategory','Admin::addCategory');
$routes->post('/admin/storeCategory', 'Admin::storeCategory');
$routes->get('/admin/changeCategoryStatus/(:num)', 'Admin::changeCategoryStatus/$1');
$routes->get('/admin/deleteCategory/(:num)', 'Admin::deleteCategory/$1');
$routes->get('/admin/editCategory/(:num)', 'Admin::addCategory/$1');
$routes->post('/admin/updateCategory/(:num)', 'Admin::storeCategory/$1');


$routes->get('/admin/addParentCategory','Admin::addParentCategory');
$routes->post('/admin/storeParentCategory', 'Admin::storeParentCategory');
$routes->get('admin/editParentCategory/(:num)', 'Admin::addParentCategory/$1');
$routes->post('/admin/updateParentCategory/(:num)', 'Admin::storeParentCategory/$1');
$routes->get('/admin/deleteParentCategory/(:num)', 'Admin::deleteParentCategory/$1');
