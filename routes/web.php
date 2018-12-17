<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@homeAction')->name('home');

Route::prefix('promotions')->group(function () {
    Route::get('/', 'PromotionController@indexAction')->name('promotionIndex');
    Route::get('/{promotionId}', 'PromotionController@detailsAction')->name('promotionDetails');
    Route::post('/', 'PromotionController@createAction')->name('createPromotion');
    Route::patch('/{promotionId}', 'PromotionController@updateAction')->name('updatePromotion');
});

Route::prefix('mechanics')->group(function () {
    Route::get('/', 'MechanicController@indexAction')->name('mechanicIndex');
    Route::get('/{mechanicId}', 'MechanicController@detailsAction')->name('mechanicDetails');
    Route::post('/', 'MechanicController@createAction')->name('createMechanic');
    Route::patch('/{mechanicId}', 'MechanicController@updateAction')->name('updateMechanic');
});

Route::prefix('tiers')->group(function () {
//    Route::get('/', 'PromotionController@indexAction')->name('promotionIndex');
//    Route::get('/create', 'PromotionController@createWizardAction')->name('createWizard');
    Route::get('/{tierId}', 'TierController@detailsAction')->name('tierDetails');
    Route::post('/', 'TierController@createAction')->name('createTier');
    Route::patch('/{tierId}', 'TierController@updateAction')->name('updateTier');


    Route::prefix('items')->group(function () {
        Route::get('/{tierItemId}', 'TierController@tierItemDetailsAction')->name('tierItemDetails');
        Route::patch('/{tierItemId}', 'TierController@updateItemAction')->name('updateTierItem');
        Route::post('/', 'TierController@createTierItemAction')->name('createTierItem');
        Route::patch('/{tierItemId}', 'TierController@updateTierItemAction')->name('updateTierItem');
    });
});
