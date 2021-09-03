<?php

use Illuminate\Support\Facades\{Auth, Route};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

// смена локали
Route::get('locale/{locale}', 'Site\LocaleController@setLocale')->name('locale.set');

Route::post('/email/verify-by-code', 'Auth\VerificationController@verifyByCode')
    ->middleware('auth')
    ->name('verification.verify_by_code');

// landing page
Route::get('/', 'Site\LpController@showIndex')->name('site');
Route::get('/lp/img/RitofosTop-v2.pdf')->name('site.promo');
// страница с условием использования
Route::get('/privacy', 'Site\LpController@showPrivacy')->name('site.privacy');

// отправка формы "Есть вопросы?" в поддержку
Route::post('/support', 'Site\LpController@createSupportRequest')->name('site.support');

Route::group(['prefix' => 'payeer'], function () {
    Route::any('/success', 'Site\PayeerController@success')->name('payeer.success');
    Route::any('/fail', 'Site\PayeerController@fail')->name('payeer.fail');
    Route::any('/status', 'Site\PayeerController@status')->name('payeer.status');
});

Route::group(['prefix' => 'pm'], function () {
    Route::any('/success', 'Site\PerfectMoneyController@success')->name('pm.success');
    Route::any('/fail', 'Site\PerfectMoneyController@fail')->name('pm.fail');
    Route::any('/status', 'Site\PerfectMoneyController@status')->name('pm.status');
});

// кабинет админа
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => 'admin',
], function () {
    Route::crud('/user', 'UserCrudController');
    Route::get('/user/login-as-user/{user}', 'UserCrudController@loginAsUser')->name('admin.user.login_as_user');
    Route::post('/user/replenishment', 'UserCrudController@replenishment')->name('admin.user.replenishment');

    Route::get('/dashboard/get_stats', 'DashboardController@getStats');

    Route::get('/exchange-rate', 'ExchangeRateController@getView');

    Route::get('/setting', 'SettingController@getView');
    Route::post('/setting/update', 'SettingController@updateSetting')->name('admin.setting.update');

    Route::crud('/support-request', 'SupportRequestCrudController');

    Route::crud('/transaction', 'TransactionCrudController');
    Route::get('/transaction/{transaction}/confirm', 'TransactionCrudController@confirmTransaction')
        ->where(['id' => '[0-9]+'])->name('admin.transaction.confirm');
    Route::get('/transaction/{transaction}/cancel', 'TransactionCrudController@cancelTransaction')
        ->where(['id' => '[0-9]+'])->name('admin.transaction.cancel');

    Route::crud('/coin-order', 'CoinOrderCrudController');
});

// кабинет пользователя
Route::group([
    'namespace' => 'Cabinet',
    'middleware' => ['user', 'verified'],
], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('cabinet.dashboard');

    Route::get('/partnership-program/linear', 'PartnershipProgramController@getLinearView')->name('cabinet.partnership_program.linear');
    Route::get('/partnership-program/linear/get-referrals-for-table', 'PartnershipProgramController@getReferralsForTable');

    Route::get('/partnership-program/ranked', 'PartnershipProgramController@getRankedView')->name('cabinet.partnership_program.ranked');
    Route::get('/partnership-program/ranked/get-coin-orders-for-table', 'PartnershipProgramController@getCoinOrdersForTable');
    Route::get('/partnership-program/ranked/send-verification-code', 'PartnershipProgramController@sendVerificationCode');
    Route::post('/partnership-program/ranked/create-coin-order', 'PartnershipProgramController@createCoinOrder');

    Route::get('/transaction', 'TransactionController@index')->name('cabinet.transaction');
    Route::get('/transaction/all', 'TransactionController@getTransactions');

    Route::get('/wallet', 'WalletController@index')->name('cabinet.wallet');
    Route::get('/wallet/all', 'WalletController@getWallets');
    Route::delete('/wallet/delete/{wallet}', 'WalletController@deleteWallet')->where(['wallet' => '[0-9]+']);
    Route::post('/wallet/store', 'WalletController@storeWallet');
    Route::post('/wallet/update', 'WalletController@updateWallet');

    Route::get('/exchange-rate', 'ExchangeRateController@getView')->name('cabinet.exchange_rate');;

    Route::get('/setting', 'SettingController@index')->name('cabinet.setting');
    Route::post('/setting/update', 'SettingController@update')->name('cabinet.setting.update');

    Route::get('/purchase', 'PurchaseController@index')->name('cabinet.purchase');
    Route::get('/purchase/get-transactions', 'PurchaseController@getTransactions');
    Route::get('/purchase/get-info-for-transaction', 'PurchaseController@getInfoForTransaction');
    Route::post('/purchase/create-transaction', 'PurchaseController@createTransaction');

    Route::get('/withdraw', 'WithdrawController@index')->name('cabinet.withdraw');
    Route::get('/withdraw/get-transactions', 'WithdrawController@getTransactions');
    Route::get('/withdraw/get-info-for-transaction', 'WithdrawController@getInfoForTransaction');
    Route::get('/withdraw/send-verification-code', 'WithdrawController@sendVerificationCode');
    Route::post('/withdraw/create-transaction', 'WithdrawController@createTransaction');

    Route::get('/user/get-notifications', 'UserController@getNotifications');
    Route::post('/user/bulk-read-notifications', 'UserController@bulkReadNotifications');

    Route::get('/balance', 'BalanceController@index')->name('cabinet.balance');
    Route::get('/balance/get-transactions', 'BalanceController@getTransactions');
    Route::post('/balance/transfer-between-balances', 'BalanceController@transferBetweenBalances');

    Route::get('/stat', 'StatController@index')->name('cabinet.stat');
});
