<?php

use App\Livewire\Account\AccountTable;
use App\Livewire\Account\CreateAccount;
use App\Livewire\Account\EditAccount;
use App\Livewire\Category\CategoryTable;
use App\Livewire\Category\CreateCategory;
use App\Livewire\Category\EditCategory;
use App\Livewire\Dashboard;
use App\Livewire\Member\CreateMember;
use App\Livewire\Member\EditMember;
use App\Livewire\Member\MemberTable;
use App\Livewire\User\CreateUser;
use App\Livewire\User\EditUser;
use App\Livewire\User\UserTable;
use App\Livewire\Reports\AccountLedger;
use App\Livewire\Reports\Calendar;
use App\Livewire\Transaction\CreateTransaction;
use App\Livewire\Transaction\EditTransaction;
use App\Livewire\Transaction\TransactionTable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard - Available for all authenticated users
    Route::get('/', Dashboard::class)->name('home');

    // Categories - Admin and Super Admin only
    Route::middleware(['permission:categories.view'])->group(function () {
        Route::get('/category', CategoryTable::class)->name('category');
    });
    Route::middleware(['permission:categories.create'])->group(function () {
        Route::get('/category/create', CreateCategory::class)->name('category.create');
    });
    Route::middleware(['permission:categories.edit'])->group(function () {
        Route::get('/category/{category}/edit', EditCategory::class)->name('category.edit');
    });

    // Transactions - Based on permission
    Route::middleware(['permission:transactions.view'])->group(function () {
        Route::get('/transaction', TransactionTable::class)->name('transaction');
    });
    Route::middleware(['permission:transactions.create'])->group(function () {
        Route::get('/transaction/create', CreateTransaction::class)->name('transaction.create');
    });
    Route::middleware(['permission:transactions.edit'])->group(function () {
        Route::get('/transaction/{transaction}/edit', EditTransaction::class)->name('transaction.edit');
    });

    // Accounts - Admin and Super Admin only
    Route::middleware(['permission:accounts.view'])->group(function () {
        Route::get('/account', AccountTable::class)->name('account');
    });
    Route::middleware(['permission:accounts.create'])->group(function () {
        Route::get('/account/create', CreateAccount::class)->name('account.create');
    });
    Route::middleware(['permission:accounts.edit'])->group(function () {
        Route::get('/account/{account}/edit', EditAccount::class)->name('account.edit');
    });

    // Members - Based on permission
    Route::middleware(['permission:members.view'])->group(function () {
        Route::get('/member', MemberTable::class)->name('member.index');
    });
    Route::middleware(['permission:members.create'])->group(function () {
        Route::get('/member/create', CreateMember::class)->name('member.create');
    });
    Route::middleware(['permission:members.edit'])->group(function () {
        Route::get('/member/{member}/edit', EditMember::class)->name('member.edit');
    });

    // Users - Super Admin only
    Route::middleware(['permission:users.view'])->group(function () {
        Route::get('/user', UserTable::class)->name('user.index');
    });
    Route::middleware(['permission:users.create'])->group(function () {
        Route::get('/user/create', CreateUser::class)->name('user.create');
    });
    Route::middleware(['permission:users.edit'])->group(function () {
        Route::get('/user/{user}/edit', EditUser::class)->name('user.edit');
    });

    /*
     * Reports route
     */
    Route::middleware(['permission:reports.account-ledger'])->group(function () {
        Route::get('/account-ledger', AccountLedger::class)->name('account-ledger');
    });
    Route::middleware(['permission:reports.calendar-view'])->group(function () {
        Route::get('/calendar-view', Calendar::class)->name('calendar-view');
    });
});
