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

\Illuminate\Support\Facades\Auth::routes();

Route::prefix('enter-promo-code')->group(function () {
    Route::get('/', 'EntrantController@enterPromoCodeAction')->name('enterPromoCode');
    Route::get('/support', 'EntrantController@supportTicketAction')->name('entrantSupportTicket');
    Route::get('/urn/{urnId}', 'EntrantController@validURNAction')->name('validURN');
    Route::get('/invalid-urn', 'EntrantController@invalidURNAction')->name('invalidURN');
    Route::post('/submit-urn', 'EntrantController@submitURNAction')->name('submitURN');
    Route::post('/support', 'EntrantController@logSupportTicketAction')->name('logSupportTicket');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('promotions')->group(function () {
        Route::get('/', 'PromotionController@indexAction')->name('promotionIndex');
        Route::get('/{promotionId}', 'PromotionController@detailsAction')->name('promotionDetails');
        Route::post('/', 'PromotionController@createAction')->name('createPromotion');
        Route::patch('/{promotionId}', 'PromotionController@updateAction')->name('updatePromotion');

        Route::get('/{promotionId}/mechanics/{mechanicId}', 'MechanicController@detailsAction')->name('mechanicDetails');
        Route::get('/{promotionId}/urn-specifications/{urnSpecificationId}', 'UrnController@urnSpecificationDetailsAction')->name('urnSpecificationDetailsAction');

        Route::get('/{promotionId}/promo-terms/{promoTermId}', 'PromoTermsController@detailsAction')->name('promoTermsDetails');
        Route::get('/{promotionId}/privacy-terms/{promoTermId}', 'PrivacyTermsController@detailsAction')->name('privacyTermsDetails');

    });

    Route::prefix('mechanics')->group(function () {
        Route::get('/', 'MechanicController@indexAction')->name('mechanicIndex');
        Route::post('/', 'MechanicController@createAction')->name('createMechanic');
        Route::patch('/{mechanicId}', 'MechanicController@updateAction')->name('updateMechanic');
    });

    Route::prefix('tiers')->group(function () {
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

    Route::prefix('privacy-terms')->group(function () {
        Route::post('/', 'PrivacyTermsController@createAction')->name('createPrivacyTerms');
        Route::patch('/{urnSpecificationId}', 'PrivacyTermsController@updateAction')->name('updatePrivacyTerms');
    });

    Route::prefix('promo-terms')->group(function () {
        Route::post('/', 'PromoTermsController@createAction')->name('createPromoTerms');
        Route::patch('/{promoTermsId}', 'PromoTermsController@updateAction')->name('updatePromoTerms');
    });

    Route::prefix('urn-specifications')->group(function () {
        Route::post('/', 'UrnController@createUrnSpecificationAction')->name('createUrnSpecification');
        Route::patch('/{urnSpecificationId}', 'UrnController@updateUrnSpecificationAction')->name('updateUrnSpecification');
        Route::post('/batch/{urnSpecificationId}', 'UrnController@generateUrnBatchAction')->name('generateUrnBatch');
    });

    Route::get('/home', 'HomeController@index')->name('home');

});