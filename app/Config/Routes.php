<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'config/Routes.php')) {
    require SYSTEMPATH . 'config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// SEBELUM LOGIN

$routes->post('/', 'Users::index');
$routes->get('/', 'Users::index');
$routes->get('/view_profile', 'Users::view_profile');

$routes->get('/opl/export', 'Users::export');

$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->post('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/create', 'Admin::create', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
$routes->post('/admin/(:num)', 'Admin::update/$1', ['filter' => 'role:admin']);
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1', ['filter' => 'role:admin']);
$routes->get('/admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'role:admin']);
$routes->get('/edit_my_admin', 'Admin::edit_my_admin', ['filter' => 'role:admin']);
$routes->get('/admin/change-password/(:num)', 'Admin::changePassword/$1', ['filter' => 'role:admin']);
$routes->post('/admin/update-password/(:num)', 'Admin::updatePassword/$1', ['filter' => 'role:admin']);

$routes->get('/user', 'Users::index', ['filter' => 'role:user']);
$routes->get('/edit_my_user', 'Users::edit_my_user', ['filter' => 'role:user']);

$routes->get('/change-my-profile', 'Admin::edit_my_profile', ['filter' => 'role:admin']);
$routes->get('/update-my-profile', 'Users::edit_my_profile');
$routes->get('/change-password', 'Users::changePassword');
$routes->post('/update-password', 'Users::updatePassword');

// SETELAH LOGIN

$routes->get('/PengetahuanDasar', 'PengetahuanDasar::index/$1');
$routes->post('/PengetahuanDasar', 'PengetahuanDasar::index/$1');
$routes->get('/PengetahuanDasar/DetailsPengetahuanDasar/(:segment)', 'PengetahuanDasar::detail/$1');
$routes->post('/PengetahuanDasar/approve/(:segment)', 'PengetahuanDasar::approve/$1');
$routes->post('/PengetahuanDasar/check/(:segment)', 'PengetahuanDasar::engineer/$1');
$routes->post('/PengetahuanDasar/rejectSupervisor/(:segment)', 'PengetahuanDasar::rejectedSupervisor/$1');
$routes->post('/PengetahuanDasar/rejectEngineer/(:segment)', 'PengetahuanDasar::rejectedEngineer/$1');
$routes->post('/PengetahuanDasar/returnSupervisor/(:segment)', 'PengetahuanDasar::returnedSupervisor/$1');
$routes->post('/PengetahuanDasar/returnEngineer/(:segment)', 'PengetahuanDasar::returnedEngineer/$1');
$routes->get('/PengetahuanDasar/History', 'PengetahuanDasar::history/$1');
$routes->post('/PengetahuanDasar/History', 'PengetahuanDasar::history/$1');

$routes->get('/ListPengetahuanDasar/(:num)', 'PengetahuanDasar::inputList/$1');
$routes->post('/ListPengetahuanDasar/(:num)', 'PengetahuanDasar::inputList/$1');
$routes->get('/ListPengetahuanDasar/CreatePengetahuanDasar', 'PengetahuanDasar::create');
$routes->post('/ListPengetahuanDasar/SavePengetahuanDasar', 'PengetahuanDasar::save');
$routes->delete('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/(:num)', 'RealisasiPD::deleteTrainee/$1');
$routes->get('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/(:any)', 'PengetahuanDasar::detailInput/$1');
$routes->post('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/OpenSosialisasi/(:any)', 'PengetahuanDasar::OpenRealisasi/$1');
$routes->post('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/CloseSosialisasi/(:any)', 'PengetahuanDasar::CloseRealisasi/$1');
$routes->get('/ListPengetahuanDasar/Status/(:num)', 'PengetahuanDasar::returned/$1');
$routes->post('/ListPengetahuanDasar/Status/(:num)', 'PengetahuanDasar::returned/$1');
$routes->get('/ListPengetahuanDasar/Edit/DetailsUserPengetahuanDasar/(:num)', 'PengetahuanDasar::editReturned/$1');
$routes->post('/ListPengetahuanDasar/UpdatePengetahuanDasar/(:num)', 'PengetahuanDasar::updateReturned/$1');
$routes->get('/List-Sosialisasi-PengetahuanDasar', 'PengetahuanDasar::realisasiList');
$routes->post('/List-Sosialisasi-PengetahuanDasar', 'PengetahuanDasar::realisasiList');
$routes->get('/List-Sosialisasi-PengetahuanDasar/History/(:segment)', 'PengetahuanDasar::realisasiListHistory');
$routes->post('/List-Sosialisasi-PengetahuanDasar/History/(:segment)', 'PengetahuanDasar::realisasiListHistory');
$routes->get('/List-Sosialisasi-PengetahuanDasar/Detail-Sosialisasi-PengetahuanDasar/(:segment)', 'PengetahuanDasar::detailRealisasi/$1');
$routes->post('/List-Sosialisasi-PengetahuanDasar/Detail-Sosialisasi-PengetahuanDasar/ParafTrainee/(:segment)', 'RealisasiPD::submitRealisasi/$1');
$routes->post('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/ParafTrainer/(:segment)', 'RealisasiPD::parafTrainer/$1');

$routes->get('/Improvement', 'improvement::index/$1');
$routes->post('/Improvement', 'improvement::index/$1');
$routes->get('/Improvement/DetailsImprovement/(:segment)', 'improvement::detail/$1');
$routes->post('/Improvement/approve/(:segment)', 'improvement::approve/$1');
$routes->post('/Improvement/check/(:segment)', 'improvement::engineer/$1');
$routes->post('/Improvement/rejectSupervisor/(:segment)', 'improvement::rejectedSupervisor/$1');
$routes->post('/Improvement/rejectEngineer/(:segment)', 'improvement::rejectedEngineer/$1');
$routes->post('/Improvement/returnSupervisor/(:segment)', 'improvement::returnedSupervisor/$1');
$routes->post('/Improvement/returnEngineer/(:segment)', 'improvement::returnedEngineer/$1');
$routes->get('/Improvement/History', 'improvement::history/$1');
$routes->post('/Improvement/History', 'improvement::history/$1');

$routes->get('/ListImprovement/(:num)', 'improvement::inputList/$1');
$routes->post('/ListImprovement/(:num)', 'improvement::inputList/$1');
$routes->get('/ListImprovement/CreateImprovement', 'improvement::create');
$routes->post('/ListImprovement/SaveImprovement', 'improvement::save');
$routes->delete('/ListImprovement/DetailsUserImprovement/(:num)', 'RealisasiIM::deleteTrainee/$1');
$routes->get('/ListImprovement/DetailsUserImprovement/(:any)', 'improvement::detailInput/$1');
$routes->post('/ListImprovement/DetailsUserImprovement/OpenSosialisasi/(:any)', 'Improvement::OpenRealisasi/$1');
$routes->post('/ListImprovement/DetailsUserImprovement/CloseSosialisasi/(:any)', 'Improvement::CloseRealisasi/$1');
$routes->get('/ListImprovement/Status/(:num)', 'improvement::returned/$1');
$routes->post('/ListImprovement/Status/(:num)', 'improvement::returned/$1');
$routes->get('/ListImprovement/Edit/DetailsUserImprovement/(:num)', 'improvement::editReturned/$1');
$routes->post('/ListImprovement/UpdateImprovement/(:num)', 'improvement::updateReturned/$1');
$routes->get('/List-Sosialisasi-Improvement', 'improvement::realisasiList');
$routes->post('/List-Sosialisasi-Improvement', 'improvement::realisasiList');
$routes->get('/List-Sosialisasi-Improvement/Detail-Sosialisasi-Improvement/(:segment)', 'improvement::detailRealisasi/$1');
$routes->post('/List-Sosialisasi-Improvement/Detail-Sosialisasi-Improvement/ParafTrainee/(:segment)', 'RealisasiIM::submitRealisasi/$1');
$routes->post('/ListImprovement/DetailsUserImprovement/ParafTrainer/(:segment)', 'RealisasiIM::parafTrainer/$1');

$routes->get('/TroubleShooting', 'troubleshooting::index/$1');
$routes->post('/TroubleShooting', 'troubleshooting::index/$1');
$routes->get('/TroubleShooting/DetailsTroubleShooting/(:segment)', 'troubleshooting::detail/$1');
$routes->post('/TroubleShooting/approve/(:segment)', 'troubleshooting::approve/$1');
$routes->post('/TroubleShooting/check/(:segment)', 'troubleshooting::engineer/$1');
$routes->post('/TroubleShooting/rejectSupervisor/(:segment)', 'troubleshooting::rejectedSupervisor/$1');
$routes->post('/TroubleShooting/rejectEngineer/(:segment)', 'troubleshooting::rejectedEngineer/$1');
$routes->post('/TroubleShooting/returnSupervisor/(:segment)', 'troubleshooting::returnedSupervisor/$1');
$routes->post('/TroubleShooting/returnEngineer/(:segment)', 'troubleshooting::returnedEngineer/$1');
$routes->get('/TroubleShooting/History', 'troubleshooting::history/$1');
$routes->post('/TroubleShooting/History', 'troubleshooting::history/$1');

$routes->get('/ListTroubleShooting/(:num)', 'troubleshooting::inputList/$1');
$routes->post('/ListTroubleShooting/(:num)', 'troubleshooting::inputList/$1');
$routes->get('/ListTroubleShooting/CreateTroubleShooting', 'troubleshooting::create');
$routes->post('/ListTroubleShooting/SaveTroubleShooting', 'troubleshooting::save');
$routes->delete('/ListTroubleShooting/DetailsUserTroubleShooting/(:num)', 'RealisasiTS::deleteTrainee/$1');
$routes->get('/ListTroubleShooting/DetailsUserTroubleShooting/(:any)', 'troubleshooting::detailInput/$1');
$routes->post('/ListTroubleShooting/DetailsUserTroubleShooting/OpenSosialisasi/(:any)', 'TroubleShooting::OpenRealisasi/$1');
$routes->post('/ListTroubleShooting/DetailsUserTroubleShooting/CloseSosialisasi/(:any)', 'TroubleShooting::CloseRealisasi/$1');
$routes->get('/ListTroubleShooting/Status/(:num)', 'troubleshooting::returned/$1');
$routes->post('/ListTroubleShooting/Status/(:num)', 'troubleshooting::returned/$1');
$routes->get('/ListTroubleShooting/Edit/DetailsUserTroubleShooting/(:num)', 'troubleshooting::editReturned/$1');
$routes->post('/ListTroubleShooting/UpdateTroubleShooting/(:num)', 'troubleshooting::updateReturned/$1');
$routes->get('/List-Sosialisasi-TroubleShooting', 'troubleshooting::realisasiList');
$routes->post('/List-Sosialisasi-TroubleShooting', 'troubleshooting::realisasiList');
$routes->get('/List-Sosialisasi-TroubleShooting/Detail-Sosialisasi-TroubleShooting/(:segment)', 'troubleshooting::detailRealisasi/$1');
$routes->post('/List-Sosialisasi-TroubleShooting/Detail-Sosialisasi-TroubleShooting/ParafTrainee/(:segment)', 'RealisasiTS::submitRealisasi/$1');
$routes->post('/ListTroubleShooting/DetailsUserTroubleShooting/ParafTrainer/(:segment)', 'RealisasiTS::parafTrainer/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
