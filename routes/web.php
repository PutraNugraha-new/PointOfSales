<?php

use App\Imports\CategoryImport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardItemController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardSupplierController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\DashboardTransactionInController;
use App\Http\Controllers\DashboardTransactionOutController;

Route::get('/guest', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

    Route::resource('items', DashboardItemController::class);
    Route::post('/importItems', [DashboardItemController::class, 'import'])->name('importItems');
    Route::get('/items/{id}/detail', [DashboardItemController::class, 'getDetail'])->name('items.detail');

    Route::resource('category', DashboardCategoryController::class);
    Route::post('/importCategory', [DashboardCategoryController::class, 'import'])->name('importCategory');

    Route::resource('suppliers', DashboardSupplierController::class);
    Route::post('/importSuppliers', [DashboardSupplierController::class, 'import'])->name('importSuppliers');
    Route::get('/suppliers/{id}/detail', [DashboardSupplierController::class, 'getDetail'])->name('suppliers.detail');

    Route::resource('users', DashboardUserController::class);
    Route::post('/importusers', [DashboardUserController::class, 'import'])->name('importUsers');
    Route::get('/users/{id}/detail', [DashboardUserController::class, 'getDetail'])->name('users.detail');

    Route::resource('transactionIn', DashboardTransactionInController::class);
    Route::get('/transactionIn/{id}/detail', [DashboardTransactionInController::class, 'getDetail'])->name('transactionIn.detail');

    Route::resource('transactionOut', DashboardTransactionOutController::class);
    Route::get('/transactionOut/{id}/detail', [DashboardTransactionOutController::class, 'getDetail'])->name('transactionOut.detail');

    Route::get('/transactions', [TransactionReportController::class, 'index'])->name('reports.transactions');
    Route::get('/reports/income-expense', [TransactionReportController::class, 'incomeExpense'])->name('reports.income-expense');
    Route::get('/reports/profitability', [TransactionReportController::class, 'profitability'])->name('reports.profitability');
});
