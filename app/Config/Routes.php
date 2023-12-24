<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function ($routes) {
    $routes->group('v1', ['namespace' => 'App\Controllers\API'], function ($routes) {
        $routes->resource('item', ['controller' => 'Item']);
        $routes->post('item/import', 'Item::import');
    });
});

$routes->group('item', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Item::index');
    $routes->get('create', 'Item::create');
    $routes->get('import', 'Item::import');
    $routes->get('export', 'Item::export');
    $routes->get('download', 'Item::download');
    $routes->post('store', 'Item::store');
    $routes->get('edit/(:num)', 'Item::edit/$1');
    $routes->post('update/(:num)', 'Item::update/$1');
    $routes->get('delete/(:num)', 'Item::delete/$1');
});
