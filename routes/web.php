<?php

// Handle installation
Route::group(['middleware' => 'install'], function(){
/*
|--------------------------------------------------------------------------
| System Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'admin'], function(){

    // Admin routes
    Route::get('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin_logout');
    Route::get('/admin/dashboard','Admin\AdminLoginController@dashboard')->name('admin_dashboard');
    Route::get('/admin/my_account','Admin\AdminController@index')->name('admin_my_account');
    Route::put('/admin/my_account/update/{id}','Admin\AdminController@update')->name('admin_my_account_update');

    // Additional Blog Routes
    Route::post('/admin/blog/activate/{id}', 'Admin\AdminBlogController@activate');
    Route::post('/admin/blog/deactivate/{id}', 'Admin\AdminBlogController@deactivate');
    Route::get('/admin/blog/autocomplete/', 'Admin\AdminBlogController@autocomplete');
    Route::post('/admin/blog/search/', 'Admin\AdminBlogController@search')->name('admin_blog_search');
    Route::post('/admin/blog/massdestroy', 'Admin\AdminBlogController@massDestroy');
    Route::post('/admin/blog/deleteImage/{id}', 'Admin\AdminBlogController@deleteFeatured');

    // Additional Page Routes
    Route::post('/admin/page/activate/{id}', 'Admin\AdminPageController@activate');
    Route::post('/admin/page/deactivate/{id}', 'Admin\AdminPageController@deactivate');
    Route::get('/admin/page/autocomplete/', 'Admin\AdminPageController@autocomplete');
    Route::post('/admin/page/search/', 'Admin\AdminPageController@search')->name('admin_page_search');
    Route::post('/admin/page/massdestroy', 'Admin\AdminPageController@massDestroy');

    Route::post('/admin/faq/massdestroy', 'Admin\AdminFaqController@massDestroy');

    // Additional Service Routes
    Route::post('/admin/service/activate/{id}', 'Admin\AdminServiceController@activate');
    Route::post('/admin/service/deactivate/{id}', 'Admin\AdminServiceController@deactivate');
    Route::post('/admin/service/makefeatured/{id}', 'Admin\AdminServiceController@makeFeatured');
    Route::post('/admin/service/makedefault/{id}', 'Admin\AdminServiceController@makeDefault');
    Route::get('/admin/service/autocomplete/', 'Admin\AdminServiceController@autocomplete');
    Route::post('/admin/service/search/', 'Admin\AdminServiceController@search')->name('admin_service_search');
    Route::post('/admin/service/massdestroy', 'Admin\AdminServiceController@massDestroy');

    // Additional Property Routes
    Route::post('/admin/property/activate/{id}', 'Admin\AdminPropertyController@activate');
    Route::post('/admin/property/deactivate/{id}', 'Admin\AdminPropertyController@deactivate');
    Route::post('/admin/property/makefeatured/{id}', 'Admin\AdminPropertyController@makeFeatured');
    Route::post('/admin/property/makedefault/{id}', 'Admin\AdminPropertyController@makeDefault');
    Route::get('/admin/property/autocomplete/', 'Admin\AdminPropertyController@autocomplete');
    Route::post('/admin/property/search/', 'Admin\AdminPropertyController@search')->name('admin_property_search');
    Route::post('/admin/property/massdestroy', 'Admin\AdminPropertyController@massDestroy');
    Route::post('/admin/property/updateDates/', 'Admin\AdminPropertyController@updateDates')->name('admin_property_update_dates');

    // Additional Taxonomy Category Routes
    Route::post('/admin/taxonomy/category/search/', 'Admin\AdminCategoryController@search')->name('admin_taxonomy_category_search');
    Route::get('/admin/taxonomy/category/autocomplete/', 'Admin\AdminCategoryController@autocomplete');
    Route::post('/admin/taxonomy/category/massdestroy', 'Admin\AdminCategoryController@massDestroy');
    Route::post('/admin/taxonomy/category/deleteImage/{id}', 'Admin\AdminCategoryController@deleteFeatured');

    // Additional Property Location Routes
    Route::post('/admin/taxonomy/location/search/', 'Admin\AdminLocationController@search')->name('admin_taxonomy_location_search');
    Route::get('/admin/taxonomy/location/autocomplete/', 'Admin\AdminLocationController@autocomplete');
    Route::post('/admin/taxonomy/location/massdestroy', 'Admin\AdminLocationController@massDestroy');
    Route::post('/admin/taxonomy/location/deleteImage/{id}', 'Admin\AdminLocationController@deleteFeatured');
    Route::post('/admin/taxonomy/location/deleteHomeImage/{id}', 'Admin\AdminLocationController@deleteHomeImage');

    // Site Settings Controller Routes
    Route::get('/admin/settings/site_settings', 'Admin\AdminSiteSettingsController@index')->name('admin_site_settings');
    Route::post('admin/settings/site_settings/insert', 'Admin\AdminSiteSettingsController@insert')->name('admin_site_settings_update');

    // Site Settings Controller Routes
    Route::get('/admin/settings/style_settings', 'Admin\AdminStyleSettingsController@index')->name('admin_style_settings');
    Route::post('admin/settings/style_settings/insert', 'Admin\AdminStyleSettingsController@insert')->name('admin_style_settings_update');

    // Property Settings Controller Routes
    Route::get('/admin/settings/property_settings', 'Admin\AdminPropertySettingsController@index')->name('admin_property_settings');
    Route::post('admin/settings/property_settings/insert', 'Admin\AdminPropertySettingsController@insert')->name('admin_property_settings_update');

    // Service Settings Controller Routes
    Route::get('/admin/settings/service_settings', 'Admin\AdminServiceSettingsController@index')->name('admin_service_settings');
    Route::post('admin/settings/service_settings/insert', 'Admin\AdminServiceSettingsController@insert')->name('admin_service_settings_update');

    // User Settings Controller Routes
    Route::get('/admin/settings/user_settings', 'Admin\AdminUserSettingsController@index')->name('admin_user_settings');
    Route::post('admin/settings/user_settings/insert', 'Admin\AdminUserSettingsController@insert')->name('admin_user_settings_update');

    // Owner Settings Controller Routes
    Route::get('/admin/settings/owner_settings', 'Admin\AdminOwnerSettingsController@index')->name('admin_owner_settings');
    Route::post('admin/settings/owner_settings/insert', 'Admin\AdminOwnerSettingsController@insert')->name('admin_owner_settings_update');

    // Purchase Controller Routes
    Route::get('/admin/owner/purchase', 'Admin\AdminPurchaseController@index')->name('admin_owner_purchase');

    // Activity Controller Routes
    Route::get('/admin/owner/activity', 'Admin\AdminActivityController@index')->name('admin_owner_activity');

    // Activity Controller Routes
    Route::get('/admin/request', 'Admin\AdminRequestController@index')->name('admin_requests');

    // Property Settings Controller Routes
    Route::get('/admin/settings/payment_settings', 'Admin\AdminPaymentSettingsController@index')->name('admin_payment_settings');
    Route::post('admin/settings/payment_settings/insert', 'Admin\AdminPaymentSettingsController@insert')->name('admin_payment_settings_update');

    // Property Settings Controller Routes
    Route::get('/admin/settings/design_settings', 'Admin\AdminDesignSettingsController@index')->name('admin_design_settings');
    Route::post('admin/settings/design_settings/insert', 'Admin\AdminDesignSettingsController@insert')->name('admin_design_settings_update');

    // Language Settings Controller Routes
    Route::get('/admin/settings/language', 'Admin\AdminLanguageController@index')->name('admin_language_settings');
    Route::post('/admin/settings/language/update', 'Admin\AdminLanguageController@update')->name('admin_language_update');
    Route::post('/admin/settings/language/makeDefault/{id}', 'Admin\AdminLanguageController@makeDefault');
    Route::post('/admin/settings/language/destroy/{id}', 'Admin\AdminLanguageController@destroy');

    // Property Features Controller Routes
    Route::get('/admin/taxonomy/feature', 'Admin\AdminFeatureController@index')->name('admin_taxonomy_feature');
    Route::get('/admin/taxonomy/feature/getFeature/{id}', 'Admin\AdminFeatureController@getFeature');
    Route::post('/admin/taxonomy/feature/update', 'Admin\AdminFeatureController@update')->name('admin_taxonomy_feature_update');
    Route::post('/admin/taxonomy/feature/store', 'Admin\AdminFeatureController@store')->name('admin_taxonomy_feature_store');
    Route::post('/admin/taxonomy/feature/destroy/{id}', 'Admin\AdminFeatureController@destroy');

    // Property Features Controller Routes
    Route::get('/admin/setting/currency', 'Admin\AdminCurrencyController@index')->name('admin_currency');
    Route::get('/admin/setting/currency/getCurrency/{id}', 'Admin\AdminCurrencyController@getCurrency');
    Route::post('/admin/setting/currency/store', 'Admin\AdminCurrencyController@store')->name('admin_currency_store');
    Route::post('/admin/setting/currency/destroy/{id}', 'Admin\AdminCurrencyController@destroy');

    // Property Review Controller Routes
    Route::get('/admin/review', 'Admin\AdminReviewController@index')->name('admin_review');
    Route::post('/admin/review/complete/{id}', 'Admin\AdminReviewController@complete');
    Route::post('/admin/review/dismiss/{id}', 'Admin\AdminReviewController@dismiss');
    Route::post('/admin/review/delete/{id}', 'Admin\AdminReviewController@delete');
    Route::post('/admin/review/getReview/{id}', 'Admin\AdminReviewController@getReview');

    // Users Controller Rutes
    Route::get('/admin/user', 'Admin\AdminUserController@index')->name('admin_users');
    Route::get('/admin/user/autocomplete/', 'Admin\AdminUserController@autocomplete');
    Route::get('/admin/user/userinfo/', 'Admin\AdminUserController@userinfo');
    Route::post('/admin/user/search/', 'Admin\AdminUserController@search')->name('admin_user_search');
    Route::post('/admin/user/destroy/{id}', 'Admin\AdminUserController@destroy');
    Route::post('/admin/user/upgrade/{id}', 'Admin\AdminUserController@upgrade');
    Route::post('/admin/user/massdestroy', 'Admin\AdminUserController@massDestroy');
    Route::post('/admin/user/update', 'Admin\AdminUserController@update')->name('admin_user_update');
    Route::post('/admin/user/activate/{id}', 'Admin\AdminUserController@activate');
    Route::post('/admin/user/deactivate/{id}', 'Admin\AdminUserController@deactivate');

    // User Requests Controller Routes
    Route::get('/admin/user/request', 'Admin\AdminUserRequestController@index')->name('admin_users_request');
    Route::post('/admin/user/request/complete/{id}', 'Admin\AdminUserRequestController@complete');
    Route::post('/admin/user/request/dismiss/{id}', 'Admin\AdminUserRequestController@dismiss');
    Route::post('/admin/user/request/delete/{id}', 'Admin\AdminUserRequestController@delete');

    // User Withdrawal Controller Routes
    Route::get('/admin/owner/withdrawal', 'Admin\AdminWithdrawalController@index')->name('admin_user_withdrawals');
    Route::post('/admin/owner/withdrawal/complete/{id}', 'Admin\AdminWithdrawalController@complete');
    Route::post('/admin/owner/withdrawal/dismiss/{id}', 'Admin\AdminWithdrawalController@dismiss');
    Route::post('/admin/owner/withdrawal/delete/{id}', 'Admin\AdminWithdrawalController@delete');
    Route::post('/admin/owner/withdrawal/details/{id}', 'Admin\AdminWithdrawalController@userInfo');

    // Bookings Controller Routes
    Route::get('/admin/booking', 'Admin\AdminBookingController@index')->name('admin_booking');
    Route::post('/admin/booking/user_details/{id}', 'Admin\AdminBookingController@userInfo');
    Route::post('/admin/booking/delete/{id}', 'Admin\AdminBookingController@delete');
    Route::post('/admin/booking/activate/{id}', 'Admin\AdminBookingController@activate');
    Route::post('/admin/booking/reject/{id}', 'Admin\AdminBookingController@reject');

    // Message Controller Routes
    Route::get('/admin/message', 'Admin\AdminMessageController@index')->name('admin_message');
    Route::get('/admin/message/{id}', 'Admin\AdminMessageController@thread')->name('admin_message_list');
    Route::post('/admin/message/reply/{id}', 'Admin\AdminMessageController@reply')->name('admin_message_reply');
    Route::post('/admin/message/delete/{id}', 'Admin\AdminMessageController@delete');
    Route::post('/admin/message/close/{id}', 'Admin\AdminMessageController@close');

    // Payment Controller Routes
    Route::get('/admin/payment', 'Admin\AdminPaymentController@index')->name('admin_payment');
    Route::post('/admin/payment/details/{id}', 'Admin\AdminPaymentController@details');

    // Translator Controller Routers
    Route::get('/admin/settings/translator', 'Admin\AdminTranslatorController@index')->name('admin_translator');
    Route::post('/admin/settings/translator/getString/{key}', 'Admin\AdminTranslatorController@getString');
    Route::post('/admin/settings/translator/updateString', 'Admin\AdminTranslatorController@updateString');
    Route::post('/admin/settings/translator/createString', 'Admin\AdminTranslatorController@createString')->name('admin_create_string');
    Route::get('/admin/settings/translator/export', 'Admin\AdminLanguageController@export')->name('strings_export');
    Route::post('/admin/settings/translator/import', 'Admin\AdminLanguageController@import')->name('strings_import');

    // Availability Dates Controller Routes
    Route::get('/admin/property/date/{id}', 'Admin\AdminPropertyDateController@index')->name('admin_property_date');

    //  Owners Controller Routes
    Route::get('/admin/owner', 'Admin\AdminOwnerController@index')->name('admin_owner');
    Route::get('/admin/owner/edit/{id}', 'Admin\AdminOwnerController@edit')->name('admin_owner_edit');
    Route::post('/admin/owner/update/{id}', 'Admin\AdminOwnerController@update')->name('admin_owner_update');
    Route::post('/admin/owner/activate/{id}', 'Admin\AdminOwnerController@activate');
    Route::post('/admin/owner/deactivate/{id}', 'Admin\AdminOwnerController@deactivate');
    Route::post('/admin/owner/destroy/{id}', 'Admin\AdminOwnerController@delete');
    Route::post('/admin/owner/deleteImage/{id}', 'Admin\AdminOwnerController@deleteImage');
    Route::get('/admin/owner/properties/{id}', 'Admin\AdminOwnerController@allproperties')->name('admin_owner_properties');
    Route::get('/admin/owner/services/{id}', 'Admin\AdminOwnerController@allservices')->name('admin_owner_services');
    Route::get('/admin/owner/activities/{id}', 'Admin\AdminOwnerController@allactivities')->name('admin_owner_activities');
    Route::get('/admin/owner/purchases/{id}', 'Admin\AdminOwnerController@allpurchases')->name('admin_owner_purchases');
    Route::get('/admin/owner/withdrawals/{id}', 'Admin\AdminOwnerController@allwithdrawals')->name('admin_owner_withdrawals');
    Route::get('/admin/owner/autocomplete/', 'Admin\AdminOwnerController@autocomplete');
    Route::post('/admin/owner/search/', 'Admin\AdminOwnerController@search')->name('admin_owner_search');

    // Resource Admin Controllers
    Route::resource('/admin/blog', 'Admin\AdminBlogController', ['as' => 'admin']);
    Route::resource('/admin/page', 'Admin\AdminPageController', ['as' => 'admin']);
    Route::resource('/admin/faq', 'Admin\AdminFaqController', ['as' => 'admin']);
    Route::resource('/admin/service', 'Admin\AdminServiceController', ['as' => 'admin']);
    Route::resource('/admin/taxonomy/category', 'Admin\AdminCategoryController', ['as' => 'admin.taxonomy']);
    Route::resource('/admin/taxonomy/location', 'Admin\AdminLocationController', ['as' => 'admin.taxonomy']);
    Route::resource('/admin/property', 'Admin\AdminPropertyController', ['as' => 'admin']);

});

Route::get('/admin', 'Admin\AdminLoginController@index')->name('admin_login');
Route::get('/admin/reset', 'Admin\AdminLoginController@resetPassword')->name('admin_reset');

// Image Handler
Route::get('/image_handler', 'ImageHandler@index');
Route::post('/image_handler/upload', 'ImageHandler@store')->name('image_handler_upload');
Route::post('/image_handler/delete', 'ImageHandler@delete')->name('image_handler_delete');
Route::post('/image_handler/deleteBase', 'ImageHandler@deleteBase')->name('image_handler_deleteBase');

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'user'], function(){

    // Only for users
    Route::get('/my-account', 'UserController@index')->name('my_account');
    Route::post('/user-update', 'UserController@update')->name('user_update');
    Route::post('/user-request', 'UserController@request');

    // Message Controller Routes
    Route::get('/message', 'MessageController@index')->name('message');
    Route::get('/message/{id}', 'MessageController@thread')->name('message_list');
    Route::post('/message/reply/{id}', 'MessageController@reply')->name('message_reply');
    Route::post('/message/post', 'MessageController@post')->name('message_owner');

});

// Updating Booksi
Route::get('/update-booksi', 'UpdateController@update');

// Home Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/resend', 'UserController@resend')->name('resend_activation_mail');
Route::post('/user/changeLanguage', 'UserController@changeLanguage')->name('change_language');
Route::post('/user/changeCurrency', 'UserController@changeCurrency')->name('change_currency');
Route::get('/user/reset', 'UserController@resetPassword')->name('reset_password');
Route::post('/user/resend_mail', 'Auth\LoginController@resendMail')->name('resend_activation');
Route::get('/user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');
Route::get('/user-register', 'UserController@register')->name('register')->middleware('logged');
Route::post('/reCaptcha', 'HomeController@reCaptcha')->name('reCaptcha');
Route::post('/review', 'HomeController@review')->name('make_review');
Route::get('/login', 'UserController@login')->name('login')->middleware('logged');
Route::get('/activate-account', 'UserController@activateAccount')->name('activate_account');
Route::post('/search', 'SearchController@index')->name('search');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/mail/sendcontact', 'EmailController@contact')->name('send_contact');
Route::get('/blog', 'BlogController@index')->name('blog');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/page/{alias}', 'PageController@index')->name('page');
Route::get('/blog/post/{alias}', 'BlogController@post');
Route::get('/explore/properties', 'ExploreController@properties')->name('explore_properties');

Route::get('/single', 'HomeController@single')->name('single');

// Payments
Route::post('/payment-page', 'PaymentController@index')->name('booking_pay_page');
Route::post('/booking/payment', 'PaymentController@payment')->name('booking_pay');
Route::get('/booking/payment/success', 'PaymentController@paymentSuccess')->name('book_payment_success');
Route::get('/booking/payment/cancel', 'PaymentController@paymentCancel')->name('book_payment_cancel');
Route::get('/booking/payment/thank-you', 'PaymentController@paymentThankYou')->name('book_payment_thank_you');

// Social login
Route::get('/facebook/redirect', 'SocialLoginController@facebookRedirect')->name('facebook_redirect');
Route::get('/facebook/callback', 'SocialLoginController@facebookCallback')->name('facebook_callback');
Route::get('/google/redirect', 'SocialLoginController@googleRedirect')->name('google_redirect');
Route::get('/google/callback', 'SocialLoginController@googleCallback')->name('google_callback');

// Explore
Route::get('/explore/getproperties', 'ExploreController@get_properties');
Route::get('/explore/getservices', 'ExploreController@get_services');

// Filter
Route::post('/filter/properties', 'FilterController@properties');
Route::post('/filter/services', 'FilterController@services');

// Services
Route::get('/service/{alias}', 'ServiceController@index');

// Properties
Route::get('/property/{alias}', 'PropertyController@index');
Route::post('/bookproperty', 'PropertyController@book');

// Categories
Route::get('/category/{id}/properties', 'CategoryController@get_properties');
Route::get('/category/{id}/services', 'CategoryController@get_services');
Route::get('/category/{alias}', 'CategoryController@index');

// Locations
Route::get('/location/{id}/services', 'LocationController@get_services');
Route::get('/location/{id}/properties', 'LocationController@get_properties');
Route::get('/location/{alias}', 'LocationController@index');

/*
|--------------------------------------------------------------------------
| Owners Routes
|--------------------------------------------------------------------------
*/
Route::get('/owner', 'Owner\OwnerLoginController@index')->name('owners_login');

Route::group(['middleware' => 'owner'], function(){

    // owner routes
    Route::get('/owner/logout', 'Owner\OwnerLoginController@logout')->name('owner_logout');
    Route::get('/owner/dashboard','Owner\OwnerLoginController@dashboard')->name('owner_dashboard');
    Route::get('/owner/booksi','Owner\OwnerLoginController@booksi')->name('owner_booksi');
    Route::get('/owner/faq','Owner\OwnerLoginController@faq')->name('owner_faq');
    Route::get('/owner/my_account','Owner\OwnerController@index')->name('owner_my_account');
    Route::put('/owner/my_account/update/{id}','Owner\OwnerController@update')->name('owner_my_account_update');

    // Owner Payments
    Route::post('/owner/payment', 'Owner\OwnerPaymentController@payment')->name('owner_payment');
    Route::get('/owner/payment/success', 'Owner\OwnerPaymentController@paymentSuccess')->name('payment_success');
    Route::get('/owner/payment/cancel', 'Owner\OwnerPaymentController@paymentCancel')->name('payment_cancel');
    Route::get('/owner/payment/thank-you', 'Owner\OwnerPaymentController@paymentThankYou')->name('payment_thank_you');

    Route::group(['middleware' => 'owner_active'], function(){
        // Additional Service Routes
        Route::post('/owner/service/activate/{id}', 'Owner\OwnerServiceController@activate');
        Route::post('/owner/service/deactivate/{id}', 'Owner\OwnerServiceController@deactivate');
        Route::post('/owner/service/makefeatured/{id}', 'Owner\OwnerServiceController@makeFeatured');
        Route::post('/owner/service/makedefault/{id}', 'Owner\OwnerServiceController@makeDefault');
        Route::get('/owner/service/autocomplete/', 'Owner\OwnerServiceController@autocomplete');
        Route::post('/owner/service/search/', 'Owner\OwnerServiceController@search')->name('owner_service_search');
        Route::post('/owner/service/massdestroy', 'Owner\OwnerServiceController@massDestroy');

        // Payment Controller Routes
        Route::get('/owner/list-payment', 'Owner\OwnerPaymentListController@index')->name('owner_list_payment');
        Route::post('/owner/list-payment/details/{id}', 'Owner\OwnerPaymentListController@details');

        // Additional Property Routes
        Route::post('/owner/property/activate/{id}', 'Owner\OwnerPropertyController@activate');
        Route::post('/owner/property/deactivate/{id}', 'Owner\OwnerPropertyController@deactivate');
        Route::post('/owner/property/makefeatured/{id}', 'Owner\OwnerPropertyController@makeFeatured');
        Route::post('/owner/property/makedefault/{id}', 'Owner\OwnerPropertyController@makeDefault');
        Route::get('/owner/property/autocomplete/', 'Owner\OwnerPropertyController@autocomplete');
        Route::post('/owner/property/search/', 'Owner\OwnerPropertyController@search')->name('owner_property_search');
        Route::post('/owner/property/massdestroy', 'Owner\OwnerPropertyController@massDestroy');
        Route::post('/owner/property/updateDates/', 'Owner\OwnerPropertyController@updateDates')->name('owner_property_update_dates');

        // Property Review Controller Routes
        Route::get('/owner/review', 'Owner\OwnerReviewController@index')->name('owner_review');
        Route::post('/owner/review/getReview/{id}', 'Owner\OwnerReviewController@getReview');

        Route::get('/owner/withdrawal', 'Owner\OwnerWithdrawalController@index')->name('owner_withdrawal');
        Route::post('/owner/withdrawal/request', 'Owner\OwnerWithdrawalController@request')->name('request_withdrawal');
        Route::post('/owner/withdrawal/details/{id}', 'Owner\OwnerWithdrawalController@userInfo');

        // Message Controller Routes
        Route::get('/owner/message', 'Owner\OwnerMessageController@index')->name('owner_message');
        Route::get('/owner/message/{id}', 'Owner\OwnerMessageController@thread')->name('owner_message_list');
        Route::post('/owner/message/reply/{id}', 'Owner\OwnerMessageController@reply')->name('owner_message_reply');
        Route::post('/owner/message/delete/{id}', 'Owner\OwnerMessageController@delete');
        Route::post('/owner/message/close/{id}', 'Owner\OwnerMessageController@close');

        // Purchases and Activities
        Route::get('/owner/activities', 'Owner\OwnerActivityController@index')->name('owner_activities');
        Route::get('/owner/purchases', 'Owner\OwnerPurchaseController@index')->name('owner_purchases');
        Route::get('/owner/prices', 'Owner\OwnerPaymentController@prices')->name('owner_prices');
        Route::get('/owner/points', 'Owner\OwnerPointController@index')->name('owner_points');

        // Owner Payments Points
        Route::post('/owner/points/payment', 'Owner\OwnerPointController@payment')->name('owner_point_payment');
        Route::get('/owner/points/payment/success', 'Owner\OwnerPointController@paymentSuccess')->name('payment_point_success');
        Route::get('/owner/points/payment/cancel', 'Owner\OwnerPointController@paymentCancel')->name('payment_point_cancel');

        // Bookings Controller Routes
        Route::get('/owner/booking', 'Owner\OwnerBookingController@index')->name('owner_booking');
        Route::post('/owner/booking/user_details/{id}', 'Owner\OwnerBookingController@userInfo');
        Route::post('/owner/booking/delete/{id}', 'Owner\OwnerBookingController@delete');
        Route::post('/owner/booking/activate/{id}', 'Owner\OwnerBookingController@activate');
        Route::post('/owner/booking/reject/{id}', 'Owner\OwnerBookingController@reject');

        // Availability Dates Controller Routes
        Route::get('/owner/property/date/{id}', 'Owner\OwnerPropertyDateController@index')->name('owner_property_date');

        // Resource Owner Controllers
        Route::resource('/owner/service', 'Owner\OwnerServiceController', ['as' => 'owner']);
        Route::resource('/owner/property', 'Owner\OwnerPropertyController', ['as' => 'owner']);

    });
});

});
