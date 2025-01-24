<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Profile
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', url('/profile'));
});

// Dashboard > Items
Breadcrumbs::for('items.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Items', route('items.index'));
});

// Dashboard > Items > Create
Breadcrumbs::for('items.create', function (BreadcrumbTrail $trail) {
    $trail->parent('items.index');
    $trail->push('Create Item', route('items.create'));
});

// Dashboard > Items > Edit
Breadcrumbs::for('items.edit', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('items.index');
    $trail->push('Edit Item', route('items.edit', $item));
});

// Dashboard > Items > Detail
Breadcrumbs::for('items.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('items.index');
    $trail->push('Item Detail', route('items.detail', $id));
});

// Dashboard > Categories
Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('category.index'));
});

// Dashboard > Categories > Create
Breadcrumbs::for('category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('category.index');
    $trail->push('Create Category', route('category.create'));
});

// Dashboard > Categories > Edit
Breadcrumbs::for('category.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.index');
    $trail->push('Edit Category', route('category.edit', $category));
});

// Dashboard > Suppliers
Breadcrumbs::for('suppliers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Suppliers', route('suppliers.index'));
});

// Dashboard > Suppliers > Create
Breadcrumbs::for('suppliers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('suppliers.index');
    $trail->push('Create Supplier', route('suppliers.create'));
});

// Dashboard > Suppliers > Edit
Breadcrumbs::for('suppliers.edit', function (BreadcrumbTrail $trail, $supplier) {
    $trail->parent('suppliers.index');
    $trail->push('Edit Supplier', route('suppliers.edit', $supplier));
});

// Dashboard > Suppliers > Detail
Breadcrumbs::for('suppliers.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('suppliers.index');
    $trail->push('Supplier Detail', route('suppliers.detail', $id));
});

// Dashboard > Users
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

// Dashboard > Users > Create
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Create Users', route('users.create'));
});

// Dashboard > Users > Edit
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Edit Users', route('users.edit', $user));
});

// Dashboard > Users > Detail
Breadcrumbs::for('users.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('users.index');
    $trail->push('Users Detail', route('users.detail', $id));
});

// Dashboard > transactionIn
Breadcrumbs::for('transactionIn.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('TransactionIn', route('transactionIn.index'));
});

// Dashboard > transactionIn > Create
Breadcrumbs::for('transactionIn.create', function (BreadcrumbTrail $trail) {
    $trail->parent('transactionIn.index');
    $trail->push('Create TransactionIn', route('transactionIn.create'));
});

// Dashboard > transactionIn > Edit
Breadcrumbs::for('transactionIn.edit', function (BreadcrumbTrail $trail, $transactionIn) {
    $trail->parent('transactionIn.index');
    $trail->push('Edit TransactionIn', route('transactionIn.edit', $transactionIn));
});

// Dashboard > transactionIn > Detail
Breadcrumbs::for('transactionIn.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('transactionIn.index');
    $trail->push('TransactionIn Detail', route('transactionIn.detail', $id));
});

// Dashboard > transactionOut
Breadcrumbs::for('transactionOut.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('transactionOut', route('transactionOut.index'));
});

// Dashboard > transactionOut > Create
Breadcrumbs::for('transactionOut.create', function (BreadcrumbTrail $trail) {
    $trail->parent('transactionOut.index');
    $trail->push('Create transactionOut', route('transactionOut.create'));
});

// Dashboard > transactionOut > Edit
Breadcrumbs::for('transactionOut.edit', function (BreadcrumbTrail $trail, $transactionOut) {
    $trail->parent('transactionOut.index');
    $trail->push('Edit transactionOut', route('transactionOut.edit', $transactionOut));
});

// Dashboard > transactionOut > Detail
Breadcrumbs::for('transactionOut.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('transactionOut.index');
    $trail->push('transactionOut Detail', route('transactionOut.detail', $id));
});

// Dashboard > transactions
Breadcrumbs::for('reports.transactions', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Transaksi', route('reports.transactions'));
});

// Dashboard > applicationsettings
Breadcrumbs::for('appSett.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Application Settings', route('appSett.index'));
});

// Dashboard > appSett > Create
Breadcrumbs::for('appSett.create', function (BreadcrumbTrail $trail) {
    $trail->parent('appSett.index');
    $trail->push('Create Application Settings', route('appSett.create'));
});

// Dashboard > appSett > Edit
Breadcrumbs::for('appSett.edit', function (BreadcrumbTrail $trail, $appSett) {
    $trail->parent('appSett.index');
    $trail->push('Edit Application Settings', route('appSett.edit', $appSett));
});

// Dashboard > appSett > Detail
Breadcrumbs::for('appSett.detail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('appSett.index');
    $trail->push('Application Settings Detail', route('appSett.detail', $id));
});
