<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function (){
    return view('auth.login');
});

Route::get('/404page', function (){
    return view('new_theme/errors/404');
});

Route::get('/clear',function()
{
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize');

    return 'cache clear';
});

Route::get('/send-mail', 'DatabaseMappingController@sendEmail');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/order-now', 'HomeController@orderNow')->name('order.now');
Route::get('/wy-registered-agent-service', 'HomeController@wyRegisteredAgentService')->name('wy.registered.agent.service');
Route::get('/contact-us', 'HomeController@contactUs')->name('contact.us');
Route::get('/faqs', 'HomeController@faqs')->name('faqs');
Route::get('/wy-registered-agent', 'HomeController@wyRegisteredAgent')->name('wy.registered.agent');
Route::get('/choose-a-wyoming-llc', 'HomeController@chooseAWyomingLlc')->name('choose.a.wyoming.llc');
Route::get('/how-to-file-your-wy-llc', 'HomeController@howToFileYourWyLlc')->name('how.to.file.your.wy.llc');
Route::get('/terms-and-conditions', 'HomeController@termAndConditions')->name('terms.and.conditions');
Route::get('/renew-agent-llc', 'HomeController@renewAgentLLC')->name('renew.agent.llc');
Route::get('/payment-success', 'HomeController@orderDone')->name('order.done');
Route::post('upload', 'DatabaseMappingController@uploadFile')->name('upload.files');
Route::post('send-and-save', 'DatabaseMappingController@sendAndSave')->name('send.save');
Route::get('get-attachments', 'DatabaseMappingController@getAttachment')->name('get.attachment');

Route::get('/home', 'DatabaseMappingController@index')->name('home1');
Route::post('/save-data', 'DatabaseMappingController@saveData')->name('save');
Route::get('/home2', 'DatabaseMappingController@index2')->name('home2');
Route::post('stripe-payment/charge', 'DatabaseMappingController@charge');

Route::get('/tables','DatabaseMappingController@index')->name('tables');
Route::post('/table-columns','DatabaseMappingController@tableColumn')->name('table-columns');
Route::post('/insert-data','DatabaseMappingController@insertData')->name('insert-data');


Route::get('/login', function () {
    return view('auth.login');
})->name('admin.login');
Route::get('/user', function () {
    return view('auth.user');
});
Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Auth::routes();

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'client',
    'namespace'     => 'Client'
], function ()
{
    Route::get('/dashboard', 'ClientController@index')->name('client.dashboard');
	Route::get('/profile', 'ClientController@edit')->name('client-profile');
	Route::post('/admin-update', 'ClientController@update')->name('client-update');
    Route::get('/client-change-password', 'ClientController@changePasswordForm')->name('client-change-password');
    Route::get('/check-current-password/{password}', 'ClientController@checkClientCurrentPassword')->name('check-current-password');
    Route::post('/change-password', 'ClientController@changePassword')->name('client.change-password');
    Route::post('/plan-subscribe', 'ClientController@subscribeCustomer')->name('plan-subscribe');
    Route::get('/plan-unsubscribe/{plan_id}/{subscription_id}', 'ClientController@cancelPlanSubscription')->name('plan-unsubscribe');
    //Payments
    Route::get('/payment/{id}', 'PaymentController@stripe')->name('stripe');
    Route::post('stripe', 'PaymentController@stripepost')->name('stripe.post');

    Route::post('/promo/post', 'PaymentController@promo_code')->name('promo.code');
});

Route::group([
    'middleware'    => ['auth','is_admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{
    
     Route::get('/pages', 'AdminController@pageData')->name('admin.page.data');
     
     Route::get('/orders', 'AdminController@orderData')->name('admin.order.data');
     Route::post('/get-orders', 'AdminController@getOrderData')->name('admin.order.getdata');
     Route::get('order/delete/{id}', 'AdminController@deleteOrder');
     Route::get('/get_order_info', 'AdminController@getSingleOrderData')->name('admin.single.order.data');
     
     Route::post('/store-order-page-content', 'AdminController@storeOrderPageContent')->name('admin.store.order.page.content');
     Route::post('/store-home-page-content', 'AdminController@storeHomePageContent')->name('admin.store.home.page.content');
     Route::post('/store-service-page-content', 'AdminController@storeServicePageContent')->name('admin.store.service.page.content');
     Route::post('/store-contact-page-content', 'AdminController@storeContactPageContent')->name('admin.store.contact.page.content');
     Route::post('/store-faqs-page-content', 'AdminController@storeFaqsPageContent')->name('admin.store.faqs.page.content');
     Route::post('/store-wyregister-page-content', 'AdminController@storeWyregisterPageContent')->name('admin.store.wyregister.page.content');
     Route::post('/store-choose-page-content', 'AdminController@storeChoosePageContent')->name('admin.store.choose.page.content');
     Route::post('/store-how-page-content', 'AdminController@storeHowPageContent')->name('admin.store.how.page.content');
     Route::post('/store-term-page-content', 'AdminController@storeTermPageContent')->name('admin.store.term.page.content');
     Route::post('/store-renew-page-content', 'AdminController@storeRenewPageContent')->name('admin.store.renew.page.content');
     
     
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');
    //Setting Routes
    Route::resource('setting','SettingController');

    Route::post('get-categories', 'CategoryController@getCategories')->name('admin.getCategories');
	Route::post('get-category', 'CategoryController@categoryDetail')->name('admin.getCategory');
	Route::get('category/delete/{id}', 'CategoryController@destroy');
	Route::post('delete-selected-categories', 'CategoryController@deleteSelectedCategories')->name('admin.delete-selected-categories');
    Route::resource('categories','CategoryController');

    Route::post('get-sliderImages', 'SliderController@getsliderimages')->name('admin.get-sliderImages');
    Route::get('sliderImage/delete/{id}', 'SliderController@destroy');
	Route::resource('sliderImages','SliderController');


    Route::resource('countries','CountryController');
	Route::post('get-countries', 'CountryController@getCountries')->name('admin.getCountries');
	Route::post('get-country', 'CountryController@countryDetail')->name('admin.getCountry');
	Route::get('country/delete/{id}', 'CountryController@destroy');
	Route::post('delete-selected-countries', 'CountryController@deleteSelectedCountries')->name('admin.delete-selected-countries');

    // Route::get('stores','StoreController@index')->name('admin.name');
	// Route::post('get-stores', 'StoreController@getCountries')->name('admin.getStores');
	// Route::post('get-store', 'StoreController@countryDetail')->name('admin.getStore');
	// Route::get('store/delete/{id}', 'StoreController@destroy');
	// Route::post('delete-selected-stores', 'StoreController@deleteSelectedCountries')->name('admin.delete-selected-stores');

    Route::resource('stores','StoreController');
    Route::get('Stores/{id}', 'StoreController@stores')->name('admin.Stores');
    Route::post('getStores/{id}', 'StoreController@getStores')->name('admin.getStores');

    // upload store/products
    Route::get('upload-products', 'StoreController@StoreJSON');
    Route::post('stores/upload-json-data', 'StoreController@StoreJSONData')->name('stores.upload-json-data');
	Route::get('stores/delete/{id}', 'StoreController@destroy');

    Route::resource('spiderLocations','SpiderLocationController');
	Route::post('get-spiderLocations', 'SpiderLocationController@getspiderLocations')->name('admin.getspiderLocations');

    Route::resource('postal-codes','PostalCodeController');
	Route::post('get-postalCodes', 'PostalCodeController@getpostalCodes')->name('admin.getpostalCodes');
    // Route::get('spiders','SpiderController@spider')->name('admin.name');


    Route::resource('products','ProductController')->except(['show']);
    Route::get('shop-products/{id}', 'ProductController@dashboard')->name('admin.shop-products');

	Route::post('get-products', 'ProductController@getProducts')->name('admin.getProducts');
    Route::get('By-products/{id}', 'ProductController@ProductsbyCategory')->name('admin.By-products');
    Route::post('getByProducts/{id}', 'ProductController@getByProducts')->name('admin.getByProducts');

	Route::post('get-product', 'ProductController@productDetail')->name('admin.getProduct');
	Route::get('product/delete/{id}', 'ProductController@destroy');
	Route::post('delete-selected-products', 'ProductController@deleteSelectedproducts')->name('admin.delete-selected-products');


    // stripe plans
    // Route::get('plans', 'PlanController@index')->name('plans.index');
    // Route::get('plans/create', 'PlanController@create')->name('plans.create');
    // Route::post('plans/store', 'PlanController@store')->name('plans.store');
    Route::post('get-plans', 'PlanController@getPlans')->name('admin.getPlans');
    Route::get('plans/delete/{id}', 'PlanController@destroy');
    Route::resource('plans','PlanController');


    //User Routes
	Route::resource('services','ClientController');
	Route::post('get-clients', 'ClientController@getClients')->name('admin.getClients');
	Route::post('get-client', 'ClientController@clientDetail')->name('admin.getClient');
    Route::post('save-patient-history', 'ClientController@saveClientHistory')->name('admin.saveClientHistory');
    Route::post('get-patient-visit-detail', 'ClientController@clientVisitDetail')->name('admin.getClientVisitDeatails');
    Route::post('get-patient-visit-history', 'ClientController@clientVisitHistory')->name('admin.getClientVisitHistory');
	Route::get('client/delete/{id}', 'ClientController@destroy');
    Route::get('client/visit/delete/{id}', 'ClientController@deleteClientVisit');
    Route::get('client/visitinfo/delete/{id}', 'ClientController@deleteClientVisitInfo');
	Route::post('delete-selected-clients', 'ClientController@deleteSelectedClients')->name('admin.delete-selected-clients');

    Route::get('user-payments', 'UserPaymentController@index')->name('user-payments.index');
    Route::post('get-client-payments', 'UserPaymentController@getUserPayment')->name('admin.getUserPayments');

    Route::post('get-promos', 'PromoController@getpromos')->name('admin.getPromos');
	Route::post('get-promo', 'PromoController@promodetail')->name('admin.getPromo');
	Route::get('promo/delete/{id}', 'PromoController@destroy');
	Route::post('delete-selected-promos', 'PromoController@deleteselectedpromos')->name('admin.delete-selected-promos');
    Route::resource('promos','PromoController');

    Route::post('getLocations', 'LocationController@getLocations')->name('admin.getLocations');
    Route::get('paste-data/{store_id}/{location_id}', 'LocationController@pasteStoreData')->name('admin.paste-data');
    Route::post('delete-selected-locations', 'LocationController@deleteSelectedLocations')->name('admin.delete-selected-locations');
    Route::resource('locations','LocationController');
});

// Route::resource('sliderImages','SliderController');
// Route::post('get-sliderImages', 'SliderController@getsliderImages')->name('admin.getsliderImages');
// //    Route::post('get-consignWatch', 'ConsignWatchController@consignWatchesDetail')->name('admin.getconsignWatch');
// Route::get('sliderImage/delete/{id}', 'SliderController@destroy');

