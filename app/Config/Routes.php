<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Account');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Account::index');
$routes->get('/login', 'Account::login');
$routes->get('/logout', 'Account::logout');
$routes->get('/otp', 'Account::otp');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/admin_dashboard/', 'Admin_Dashboard::index');
$routes->get('/superadmin_dashboard/', 'SuperAdmin_Dashboard::index');
$routes->get('/common_fields/', 'Common_Fields::index');
// $routes->post('/add_user/', 'Admin_Dashboard::add_user');
$routes->match(['get','post'],'/save_userProfile', 'Admin_Dashboard::save_userProfile');
$routes->match(['get','post'],'/save_userProfile', 'SuperAdmin_Dashboard::save_userProfile');
$routes->match(['get','post'],'/get_userData', 'Common_Fieldsv::get_userData');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
