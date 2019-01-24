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

/** Entrant Pages (does not require authentication - e.g. 'enter promo code' */
Route::prefix('test-promo')->group(function () {
    Route::get('/', 'EntrantController@enterPromoCodeAction')->name('enterPromoCode');
    Route::get('/support', 'EntrantController@supportTicketAction')->name('entrantSupportTicket');
    Route::get('/urn/{urnId}', 'EntrantController@validURNAction')->name('validURN');
    Route::get('/invalid-urn', 'EntrantController@invalidURNAction')->name('invalidURN');
    Route::post('/submit-urn', 'EntrantController@submitURNAction')->name('submitURN');
    Route::post('/submit-validated-urn', 'EntrantController@submitValidatedURNAction')->name('submitValidatedURN');
    Route::post('/support', 'EntrantController@logSupportTicketAction')->name('logSupportTicket');
    Route::get('/support-ticket-logged/{personId}', 'EntrantController@supportTicketLoggedAction')->name('supportTicketLogged');
});


/** All main site pages require authentication */
Route::group(['middleware' => ['auth']], function () {

    /** Home */
    Route::get('/', 'HomeController@index')->name('home');

    /** Partners */
    Route::prefix('partners')->group(function () {
        Route::get('/', 'PartnerController@indexAction')->name('partnerIndex');
        Route::get('/{partnerId}', 'PartnerController@detailsAction')->name('partnerDetails');
        Route::post('/', 'PartnerController@createAction')->name('createPartner');
        Route::patch('/{partnerId}', 'PartnerController@updateAction')->name('updatePartner');
    });

    /** Promotions */
    Route::prefix('promotions')->group(function () {

        /** Promotion Basic Details */
        Route::get('/', 'PromotionController@indexAction')->name('promotionIndex');
        Route::get('/{promotionId}', 'PromotionController@detailsAction')->name('promotionDetails');
        Route::post('/', 'PromotionController@createAction')->name('createPromotion');
        Route::patch('/{promotionId}', 'PromotionController@updateAction')->name('updatePromotion');


        /** FAQ Groups */
        Route::get('/{promotionId}/faq-groups/{faqGroupId}', 'FAQController@faqGroupDetailsAction')->name('FAQGroupDetails');
        Route::post('/{promotionId}/faq-groups', 'FAQController@createFAQGroupAction')->name('createFAQGroup');
        Route::patch('/{promotionId}/faq-groups/{faqGroupId}', 'FAQController@updateFAQGroupAction')->name('updateFAQGroup');

        /** Mechanics */
        Route::get('/{promotionId}/mechanics/{mechanicId}', 'MechanicController@detailsAction')->name('mechanicDetails');
        Route::get('/{promotionId}/mechanics', 'MechanicController@indexAction')->name('mechanicIndex');
        Route::post('/{promotionId}/mechanics', 'MechanicController@createAction')->name('createMechanic');
        Route::patch('/{promotionId}/mechanics/{mechanicId}', 'MechanicController@updateAction')->name('updateMechanic');
        Route::post('/{promotionId}/urn-specifications/batch/{urnSpecificationId}', 'UrnController@generateUrnBatchAction')->name('generateUrnBatch');

        /** Privacy Terms */
        Route::get('/{promotionId}/privacy-terms/{promoTermId}', 'PrivacyTermsController@detailsAction')->name('privacyTermDetails');
        Route::post('/{promotionId}/privacy-terms', 'PrivacyTermsController@createAction')->name('createPrivacyTerms');
        Route::patch('/{promotionId}/privacy-terms/{privacyTermId}', 'PrivacyTermsController@updateAction')->name('updatePrivacyTerms');

        /** Promo Terms */
        Route::get('/{promotionId}/promo-terms/{promoTermId}', 'PromoTermsController@detailsAction')->name('promoTermDetails');
        Route::post('/{promotionId}/promo-terms', 'PromoTermsController@createAction')->name('createPromoTerms');
        Route::patch('/{promotionId}/promo-terms/{promoTermsId}', 'PromoTermsController@updateAction')->name('updatePromoTerms');

        /** Tiers */
        Route::prefix('/{promotionId}/tiers')->group(function () {

            Route::get('/{tierId}', 'TierController@detailsAction')->name('tierDetails');
            Route::post('/', 'TierController@createAction')->name('createTier');
            Route::patch('/{tierId}', 'TierController@updateAction')->name('updateTier');

            /** Tier Items */
            Route::prefix('/{tierId}/items')->group(function () {
                Route::get('/{tierItemId}', 'TierController@tierItemDetailsAction')->name('tierItemDetails');
                Route::patch('/{tierItemId}', 'TierController@updateItemAction')->name('updateTierItem');
                Route::post('/', 'TierController@createTierItemAction')->name('createTierItem');
                Route::patch('/{tierItemId}', 'TierController@updateTierItemAction')->name('updateTierItem');

                /** Tier Item Stock */
                Route::prefix('/stock')->group(function () {
                    Route::get('/{tierItemStockId}', 'TierController@tierItemStockDetailsAction')->name('tierItemStockDetails');
                    Route::patch('/{tierItemStockId}', 'TierController@updateTierItemStockAction')->name('updateTierItemStock');
//            Route::post('/', 'TierController@createTierItemAction')->name('createTierItem');
//            Route::patch('/{tierItemId}', 'TierController@updateTierItemAction')->name('updateTierItem');
                });

            });
        });

        /** URN Specifications */
        Route::prefix('/{promotionId}/urn-specifications')->group(function () {

            Route::get('/{urnSpecificationId}', 'UrnController@urnSpecificationDetailsAction')->name('urnSpecificationDetails');
            Route::post('/', 'UrnController@createUrnSpecificationAction')->name('createUrnSpecification');
            Route::patch('/{urnSpecificationId}', 'UrnController@updateUrnSpecificationAction')->name('updateUrnSpecification');

        });
    });

});