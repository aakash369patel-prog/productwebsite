<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setDefaultNamespace('App\Controllers');
$routes->setAutoRoute(false);

// Frontend routes
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->get('products', 'Products::index');
$routes->get('products/(:segment)', 'Products::index/$1');
$routes->get('product/(:segment)', 'Products::detail/$1');
$routes->post('enquiry/submit', 'Enquiry::submit');
$routes->get('sitemap.xml', 'Sitemap::index');

// Admin auth routes
$routes->group('admin', ['filter' => 'adminguest'], static function ($routes) {
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::login');
});

$routes->get('admin/logout', 'Admin\Auth::logout', ['filter' => 'adminauth']);

// Admin protected routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'adminauth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    // Categories
    $routes->get('categories', 'ProductCategory::index');
    $routes->get('categories/create', 'ProductCategory::create');
    $routes->post('categories/store', 'ProductCategory::store');
    $routes->get('categories/edit/(:num)', 'ProductCategory::edit/$1');
    $routes->post('categories/update/(:num)', 'ProductCategory::update/$1');
    $routes->get('categories/view/(:num)', 'ProductCategory::view/$1');
    $routes->post('categories/delete/(:num)', 'ProductCategory::delete/$1');

    // Products
    $routes->get('products', 'Product::index');
    $routes->get('products/create', 'Product::create');
    $routes->post('products/store', 'Product::store');
    $routes->get('products/edit/(:num)', 'Product::edit/$1');
    $routes->post('products/update/(:num)', 'Product::update/$1');
    $routes->get('products/view/(:num)', 'Product::view/$1');
    $routes->post('products/delete/(:num)', 'Product::delete/$1');
    $routes->post('products/gallery/delete/(:num)', 'Product::deleteGalleryImage/$1');

    // Enquiries
    $routes->get('enquiries', 'ProductEnquiry::index');
    $routes->get('enquiries/view/(:num)', 'ProductEnquiry::view/$1');
    $routes->post('enquiries/status/(:num)', 'ProductEnquiry::updateStatus/$1');
    $routes->post('enquiries/delete/(:num)', 'ProductEnquiry::delete/$1');
});

// Error override
$routes->set404Override(static function () {
    $data = [
        'pageTitle'       => '404 - Page Not Found',
        'metaDescription' => 'Page not found',
        'metaKeywords'    => '',
    ];

    return view('frontend/layout/header', $data)
        . view('frontend/errors/404', $data)
        . view('frontend/layout/footer', $data);
});
