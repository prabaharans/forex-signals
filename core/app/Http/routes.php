<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as'=>'home','uses'=>'HomeController@getHome']);
Route::get('/menu/{id}/{name}','HomeController@menu');
Route::get('user-login',['as'=>'user-login','uses'=>'HomeController@getLogIn']);
Route::post('user-login',['as'=>'user-login','uses'=>'MemberAuthController@postLogIn']);
Route::get('user-registration',['as'=>'user-registration','uses'=>'HomeController@getRegistration']);
Route::post('user-registration',['as'=>'registration-post','uses'=>'HomeController@postRegistration']);
Route::get('payment-invoice/{id}',['as'=>'payment-invoice','uses'=>'HomeController@paymentInvoice']);


Route::post('paypal-ipn',['as'=>'paypal-ipn','uses'=>'HomeController@paypalIpn']);
Route::post('perfect-ipn',['as'=>'perfect-ipn','uses'=>'HomeController@perfectIPN']);
Route::post('stripe-preview',['as'=>'stripe-preview','uses'=>'HomeController@stripePreview']);
Route::post('stripe-submit',['as'=>'stripe-submit','uses'=>'HomeController@submitStripe']);

Route::post('btc-preview',['as'=>'btc-preview','uses'=>'HomeController@btcPreview']);
Route::get('btc_ipn/{invoice_id}/{secret}',['as'=>'btc_ipn','uses'=>'HomeController@btcIPN']);




Route::get('user-logout',['as'=>'user-logout','uses'=>'MemberAuthController@logout']);
Route::get('contact-us',['as'=>'contact-us','uses'=>'HomeController@getContact']);
Route::post('contact-send',['as'=>'contact-send','uses'=>'HomeController@postContact']);

//Authentication Route List
Route::get('/admin', ['as'=>'login', 'uses'=>'AdminAuthController@getLogin']);
Route::post('/admin', ['as'=>'admin-login', 'uses'=>'AdminAuthController@postLogin']);
Route::get('/logout', ['as'=>'logout','uses'=>'AdminAuthController@logout']);

/* Admin password Change*/
Route::get('changepass', ['as'=>'change-pass', 'uses'=>'WebSettingController@getChangePass']);
Route::post('changepass', ['as'=>'change-pass', 'uses'=>'WebSettingController@postChangePass']);

/* Admin Dashboard Route List */
Route::get('dashboard',['as'=>'dashboard','uses'=>'DashboardController@getDashboard']);

/*WebSetting Route List*/
Route::get('general-setting', ['as'=>'general-setting', 'uses'=>'WebSettingController@getGeneralSetting']);
Route::put('general-setting/{id}', ['as'=>'update_general', 'uses'=>'WebSettingController@putGeneralSetting']);

/* Slider Setting */
Route::get('slider', ['as'=>'slider', 'uses' =>'WebSettingController@getSlider']);
Route::post('slider', ['as'=>'post_slider', 'uses' =>'WebSettingController@postSlider']);
Route::delete('slider-delete', ['as'=>'slider-delete', 'uses' =>'WebSettingController@deleteSlider']);

/* Menu Route List*/
Route::get('menu-create',['as'=>'menu_create','uses'=>'WebSettingController@getMenuCreate']);
Route::post('menu-create',['as'=>'menu_create','uses'=>'WebSettingController@postMenuCreate']);
Route::get('menu-show',['as'=>'menu_show','uses'=>'WebSettingController@showMenuCreate']);
Route::get('menu-edit/{id}',['as'=>'menu-edit','uses'=>'WebSettingController@editMenuCreate']);
Route::put('menu-edit/{id}',['as'=>'menu-update','uses'=>'WebSettingController@updateMenuCreate']);
Route::delete('menu-delete/{id}',['as'=>'menu-delete','uses'=>'WebSettingController@deleteMenuCreate']);


/*Currency Route List */
Route::get('currency-create',['as'=>'currency-create','uses'=>'DashboardController@createCurrency']);
Route::post('currency-create', ['as'=>'currency_store','uses'=>'DashboardController@storeCurrency']);
Route::get('currency', ['as'=>'currency_show','uses'=>'DashboardController@showCurrency']);
Route::get('currency-edit/{id}', ['as'=>'currency_edit','uses'=>'DashboardController@editCurrency']);
Route::put('currency-edit/{id}', ['as'=>'currency_update','uses'=>'DashboardController@updateCurrency']);
Route::delete('currency-delete', ['as'=>'currency_delete','uses'=>'DashboardController@deleteCurrency']);

/* Plan Route List*/
Route::get('plan-create', ['as'=>'service-create', 'uses'=>'DashboardController@createService']);
Route::post('plan-create', ['as'=>'service-create', 'uses'=>'DashboardController@storeService']);
Route::get('plan-show', ['as'=>'service-show', 'uses'=>'DashboardController@showService']);
Route::get('plan-edit/{id}', ['as'=>'service-edit', 'uses'=>'DashboardController@editService']);
Route::put('plan-edit/{id}', ['as'=>'service-update', 'uses'=>'DashboardController@updateService']);
Route::delete('plan-delete', ['as'=>'service-delete', 'uses'=>'DashboardController@deleteService']);

/* Signal Route List */
Route::get('signal-create',['as'=>'signal-create','uses'=>'DashboardController@createSignal']);
Route::post('signal-create',['as'=>'signal-create','uses'=>'DashboardController@postSignal']);
Route::get('signal-date-show',['as'=>'signal-date-show','uses'=>'DashboardController@dateSignal']);
Route::get('signal-show/{date}',['as'=>'signal-show','uses'=>'DashboardController@showSignal']);


/* Category Route List */
Route::get('category',['as'=>'category','uses'=>'DashboardController@showCategory']);
Route::get('category/{task_id?}',['as'=>'category-edit','uses'=>'DashboardController@editCategory']);
Route::post('category',['as'=>'category','uses'=>'DashboardController@storeCategory']);
Route::put('category/{task_id?}',['as'=>'category-edit','uses'=>'DashboardController@updateCategory']);
Route::delete('category/{id?}',['as'=>'category-delete','uses'=>'DashboardController@deleteCategory']);


/* Article Route List */
Route::get('article-create',['as'=>'article-create','uses'=>'DashboardController@createArticle']);
Route::post('article-create',['as'=>'article-create','uses'=>'DashboardController@storeArticle']);
Route::get('article-show',['as'=>'article-show','uses'=>'DashboardController@showArticle']);
Route::get('article-edit/{id}',['as'=>'article-edit','uses'=>'DashboardController@editArticle']);
Route::put('article-edit/{id}',['as'=>'article-update','uses'=>'DashboardController@updateArticle']);
Route::delete('article-delete',['as'=>'article-delete','uses'=>'DashboardController@deleteArticle']);
Route::get('article-view/{id}',['as'=>'article-view','uses'=>'DashboardController@viewArticle']);

/* Testimonial Route List */
Route::get('manage-testimonial',['as'=>'manage-testimonial','uses'=>'DashboardController@mangeTestimonial']);
Route::post('manage-testimonial',['as'=>'manage-testimonial','uses'=>'DashboardController@storeTestimonial']);
Route::get('testimonial-edit/{id}',['as'=>'testimonial-edit','uses'=>'DashboardController@editTestimonial']);
Route::put('testimonial-edit/{id}',['as'=>'testimonial-update','uses'=>'DashboardController@updateTestimonial']);
Route::delete('testimonial-delete',['as'=>'testimonial-delete','uses'=>'DashboardController@deleteTestimonial']);

/* User Dashboard Controller */
Route::get('user-dashboard',['as'=>'user-dashboard','uses'=>'MemberController@getDashboard']);
Route::get('user-change-pass',['as'=>'user-change-pass','uses'=>'MemberController@changePassword']);
Route::post('user-change-pass',['as'=>'user-change-pass','uses'=>'MemberController@postPassword']);

/* User Signal Route List */
Route::get('user-signal',['as'=>'user-signal','uses'=>'MemberController@getMemberSignalDate']);
Route::get('user-signal-show/{id}',['as'=>'user-signal-show','uses'=>'MemberController@showSignal']);

/* User Article Route List */
Route::get('user-article',['as'=>'user-article','uses'=>'MemberController@getArticle']);
Route::get('user-article-view/{id}',['as'=>'user-article-view','uses'=>'MemberController@viewArticle']);

/* User Mange Route List */
Route::get('manage-member',['as'=>'manage-member','uses'=>'DashboardController@manageMember']);

/* User Message Route List */
Route::post('user-message',['as'=>'user-message','uses'=>'DashboardController@userMessage']);

/* Upcoming Route List */
Route::get('upcoming-payment',['as'=>'upcoming-payment','uses'=>'DashboardController@upcomingPayment']);


/* Admin _Payment Method*/
Route::get('payment-method',['as'=>'payment-method','uses'=>'DashboardController@getPaymentMethod']);
Route::post('payment-method',['as'=>'payment-method','uses'=>'DashboardController@updatePaymentMethod']);




/* user Forget Password */
Route::get('user-forget-password',['as'=>'user-forget-password','uses'=>'HomeController@getForgetPassword']);
Route::get('user-password-reset/{token}',['as'=>'user-password-reset','uses'=>'HomeController@resetForgetPassword']);
Route::post('user-forget-password-submit',['as'=>'user-forget-password-submit','uses'=>'HomeController@submitForgetPassword']);
Route::post('user-reset-password-submit',['as'=>'user-reset-password-submit','uses'=>'HomeController@ResetSubmitPassword']);




