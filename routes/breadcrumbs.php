<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::macro('documentTitle', function() {
    return (($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title . ' - ' : '') . request()->getHost();
});

Breadcrumbs::macro('pageTitle', function() {
    return (($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'missing title');
});

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Invoice
Breadcrumbs::for('invoice', function (BreadcrumbTrail $trail) {
    $trail->push('Invoice', route('dashboard'));
});

// Payment
Breadcrumbs::for('payment', function (BreadcrumbTrail $trail) {
    $trail->push('Payment', route('payment'));
});

// Credit
Breadcrumbs::for('credit', function (BreadcrumbTrail $trail) {
    $trail->push('Credit', route('credit'));
});

// Client
Breadcrumbs::for('client', function (BreadcrumbTrail $trail) {
    $trail->push('Client', route('client'));
});

// Setting
Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
    $trail->push('Setting', route('setting'));
});

// Setting > My Contact Info
Breadcrumbs::for('setting.contactInfo', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push('My Contact Info', route('setting.contactInfo'));
});

// Setting > Email
Breadcrumbs::for('setting.email', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push('Email', route('setting.email'));
});

// Setting > Locale
Breadcrumbs::for('setting.locale', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push('Locale', route('setting.locale'));
});

// Setting > Database
Breadcrumbs::for('setting.database', function (BreadcrumbTrail $trail) {
    $trail->parent('setting');
    $trail->push('Database', route('setting.database'));
});

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });
