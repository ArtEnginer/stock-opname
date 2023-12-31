<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {
    $routes->get('item', 'Item::index');
    $routes->get('item/(:num)', 'Item::show/$1');
    $routes->post('item', 'Item::create');
    $routes->put('item/(:num)', 'Item::update/$1');
    $routes->delete('item/(:num)', 'Item::delete/$1');
    $routes->post('item/import', 'Item::import');
    $routes->get('download', 'Item::download');
    $routes->get('item/cekitem/(:any)', 'Item::cekItem/$1');

    $routes->group('so', ['namespace' => 'App\Controllers\API'], function ($routes) {
        $routes->get('/', 'StockOpname::index');
        $routes->post('create', 'StockOpname::create');
        $routes->delete('(:num)', 'StockOpname::delete/$1');
    });
});


$routes->group('item', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Item::index');
    $routes->get('create', 'Item::create');
    $routes->get('import', 'Item::import');
    $routes->get('export', 'Item::export');
    $routes->get('cekitem', 'Item::cekItem');
});

$routes->group('so', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'StockOpname::index');
    $routes->get('create', 'StockOpname::create');
    $routes->get('import', 'StockOpname::import');
    $routes->get('export', 'StockOpname::export');
    $routes->get('cekso', 'StockOpname::cekSo');
});
