<?php
    
use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);
define('IMAGES', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR);
define('ICONS', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'icons'.DIRECTORY_SEPARATOR);

define('NAME_SITE', 'brochure-website.com');
define('DB_NAME', 'db-brochure');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PWD', 'password');
 
$router = new Router($_GET['url']);
$router->get('/', 'App\Controllers\OuvragesController@welcome');

$router->get('/reliures', 'App\Controllers\OuvragesController@reliures');
$router->get('/restaurations', 'App\Controllers\OuvragesController@restaurations');
$router->get('/boites', 'App\Controllers\OuvragesController@boites');
$router->get('/theme', 'App\Controllers\OuvragesController@theme');
$router->get('/tradition', 'App\Controllers\OuvragesController@tradition');
$router->get('/tarifs', 'App\Controllers\OuvragesController@tarifs');
$router->get('/contact', 'App\Controllers\OuvragesController@contact');
$router->get('/mentions-legales', 'App\Controllers\OuvragesController@mentionsLegales');
$router->get('/plan-du-site', 'App\Controllers\OuvragesController@planDuSite');

$router->get('/login', 'App\Controllers\UtilisateurController@login');
$router->post('/login', 'App\Controllers\UtilisateurController@loginPost');
$router->get('/logout', 'App\Controllers\UtilisateurController@logout');
$router->get('/admin/change-mdp', 'App\Controllers\UtilisateurController@changeMdp');
$router->post('/admin/change-mdp', 'App\Controllers\UtilisateurController@updateMdp');

$router->get('/admin/ouvrages', 'App\Controllers\Admin\OuvrageController@index');
$router->get('/admin/ouvrages/galerie', 'App\Controllers\Admin\OuvrageController@galerie');
$router->get('/admin/ouvrages/add', 'App\Controllers\Admin\OuvrageController@add');
$router->post('/admin/ouvrages/add', 'App\Controllers\Admin\OuvrageController@addOuvrage');
$router->post('/admin/ouvrages/delete/:id', 'App\Controllers\Admin\OuvrageController@destroy');
$router->get('/admin/ouvrages/edit/:id', 'App\Controllers\Admin\OuvrageController@edit');
$router->post('/admin/ouvrages/edit/:id', 'App\Controllers\Admin\OuvrageController@update');
$router->post('/admin/ouvrages/edit/:id', 'App\Controllers\Admin\OuvrageController@update');

$router->get('/admin/themes', 'App\Controllers\Admin\ThemeController@themes');
$router->post('/admin/themes/update', 'App\Controllers\Admin\ThemeController@update');
$router->post('/admin/themes/add', 'App\Controllers\Admin\ThemeController@add');
$router->post('/admin/themes/delete', 'App\Controllers\Admin\ThemeController@delete');

try {
    $router->run();
} catch(NotFoundException $e){
    $e->error404();
}


