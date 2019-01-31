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

        Route::group(['middleware' => ['role:super-admin|marketing']], function () {

            /** Basic Details */
            Route::get('/', 'PromotionController@indexAction')->name('promotionIndex');
            Route::get('/{promotionId}', 'PromotionController@detailsAction')->name('promotionDetails');
            Route::post('/', 'PromotionController@createAction')->name('createPromotion');
            Route::patch('/{promotionId}', 'PromotionController@updateAction')->name('updatePromotion');

            /** Partners */
            Route::prefix('/{promotionId}/partners')->group(function () {
                Route::get('/{promotionPartnerId}', 'PromotionPartnerController@detailsAction')->name('promotionPartnerDetails');
                Route::post('/', 'PromotionPartnerController@createAction')->name('createPromotionPartner');
            });

            /** Entrants */
            Route::prefix('/{promotionId}/entrants')->group(function () {
                Route::get('/{entrantId}', 'EntrantController@detailsAction')->name('entrantDetails');
            });

            /** FAQ Groups */
            Route::prefix('/{promotionId}/faq-groups')->group(function () {

                Route::get('/{faqGroupId}', 'FAQController@faqGroupDetailsAction')->name('FAQGroupDetails');
                Route::post('/', 'FAQController@createFAQGroupAction')->name('createFAQGroup');
                Route::patch('/{faqGroupId}', 'FAQController@updateFAQGroupAction')->name('updateFAQGroup');
                Route::post('/{faqGroupId}/reorder', 'FAQController@reorderFAQsAction')->name('reorderFAQs');
                Route::get('/{faqGroupId}/list-data', 'FAQController@FAQListDataAction')->name('FAQListData');

                Route::prefix('{faqGroupId}/faqs')->group(function () {
                    Route::get('/{faqId}', 'FAQController@FAQDetailsAction')->name('FAQDetails');
                    Route::patch('/{faqId}', 'FAQController@updateFAQAction')->name('updateFAQ');
                    Route::post('/', 'FAQController@createFAQAction')->name('createFAQ');
                });
            });

            /** Mechanics */
            Route::prefix('/{promotionId}/mechanics')->group(function () {
                Route::get('/{mechanicId}', 'MechanicController@detailsAction')->name('mechanicDetails');
                Route::get('/', 'MechanicController@indexAction')->name('mechanicIndex');
                Route::post('/', 'MechanicController@createAction')->name('createMechanic');
                Route::patch('/{mechanicId}', 'MechanicController@updateAction')->name('updateMechanic');
            });

            /** Privacy Terms */
            Route::prefix('/{promotionId}/privacy-terms')->group(function () {
                Route::get('/{promoTermId}', 'PrivacyTermsController@detailsAction')->name('privacyTermDetails');
                Route::post('/', 'PrivacyTermsController@createAction')->name('createPrivacyTerms');
                Route::patch('/{privacyTermId}', 'PrivacyTermsController@updateAction')->name('updatePrivacyTerms');

            });

            /** Promo Terms */
            Route::prefix('/{promotionId}/promo-terms')->group(function () {
                Route::get('/{promoTermId}', 'PromoTermsController@detailsAction')->name('promoTermDetails');
                Route::post('/', 'PromoTermsController@createAction')->name('createPromoTerms');
                Route::patch('/{promoTermsId}', 'PromoTermsController@updateAction')->name('updatePromoTerms');
            });

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
                Route::post('/batch/{urnSpecificationId}', 'UrnController@generateUrnBatchAction')->name('generateUrnBatch');

            });
        });
    });

});