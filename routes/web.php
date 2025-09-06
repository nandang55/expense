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
    Route::get('/', Dashboard::class)->name('home');

    Route::get('/category', CategoryTable::class)->name('category');
    Route::get('/category/create', CreateCategory::class)->name('category.create');
    Route::get('/category/{category}/edit', EditCategory::class)->name('category.edit');

    Route::get('/transaction', TransactionTable::class)->name('transaction');
    Route::get('/transaction/create', CreateTransaction::class)->name('transaction.create');
    Route::get('/transaction/{transaction}/edit', EditTransaction::class)->name('transaction.edit');

    Route::get('/account', AccountTable::class)->name('account');
    Route::get('/account/create', CreateAccount::class)->name('account.create');
    Route::get('/account/{account}/edit', EditAccount::class)->name('account.edit');

    Route::get('/member', MemberTable::class)->name('member.index');
    Route::get('/member/create', CreateMember::class)->name('member.create');
    Route::get('/member/{member}/edit', EditMember::class)->name('member.edit');

    Route::get('/user', UserTable::class)->name('user.index');
    Route::get('/user/create', CreateUser::class)->name('user.create');
    Route::get('/user/{user}/edit', EditUser::class)->name('user.edit');

    /*
     * Reports route
     */
    Route::get('/calendar-view', Calendar::class)->name('calendar-view');
});
