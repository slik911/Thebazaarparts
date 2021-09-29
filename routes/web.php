<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'IndexController@index')->name('parts');
Route::get('/countries/get-state', 'IndexController@getState')->name('getstate');
Route::get('/categories/{category}', 'IndexController@categories')->name('categories');
Route::get('/products/{category}/{subcategory_slug?}', 'IndexController@product')->name('products');
Route::get('/products/{category}/brand/{brand_slug}', 'IndexController@productsBrand')->name('products.brand');
Route::get('/company/products/{company_slug}', 'IndexController@CompanyProduct')->name('company.products');
Route::get('/single-product/{slug}', 'IndexController@single_product')->name('parts.single-product');
Route::get('/single-product/featured/{slug}', 'IndexController@single_featured_product')->name('parts.single-featured-product');
Route::get('/single-product/hotlist/{slug}', 'IndexController@single_hotlist_product')->name('parts.single-hotlist-product');

Route::get('/single-auth/{package}/{slug}', 'IndexController@singleAuth')->name('single.auth')->middleware('auth');

Route::post('/product/filter', 'IndexController@filter')->name('product.filter');
Route::post('/product/search', 'IndexController@productSearch')->name('product.search');
Route::post('/reviews/post', 'ReviewController@upload')->name('review.post');
Route::get('/contact-us', 'IndexController@contact')->name('contact');
Route::post('/contact-us', 'IndexController@sendContactMail')->name('contact.send');
Route::get('/registerd-sellers', 'IndexController@sellers')->name('registered.sellers');

Route::get('/profile', 'HomeController@buyerProfile')->name('buyer.profile');
Route::get('/terms_and_conditions', 'IndexController@terms')->name('terms');
Route::get('/about-us', 'IndexController@about')->name('about');
Route::get('/FAQ', 'IndexController@faq')->name('faq');
Route::get('/safety_tips', 'IndexController@safety')->name('safety');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::PUT('/profile/user/active/update', 'HomeController@updateProfile')->name('profile.update');
Route::get('/profile/user/active/get', 'HomeController@region')->name('get.region');
Route::get('/authenticated/product/manager/get/product/details/{slug}', 'ProductController@getProductDetails')->name('product.viewDetails');
Route::get('/authenticated/featured/product/manager/get/product/details/{slug}', 'FeaturedProductController@getProductDetails')->name('product.viewFeaturedDetails');
Route::get('/authenticated/hotlist/product/manager/get/product/details/{slug}', 'HotlistProductController@getProductDetails')->name('product.viewhotlistDetails');
Route::get('//authenticated/user/seller/profile/create', 'IndexController@createCompanyProfile')->name('register.company');
Route::post('/authenticated/user/buyer/profile/update', 'SellerController@updateBuyerProfile')->name('buyer.profileUpdate');
Route::get('/company-profile/{slug}', 'IndexController@company_profile')->name('parts.company_profile')->middleware('auth');
Route::get('/authenticated/user/review', 'ReviewController@getReview')->name('get.review');
Route::get('/redirect', 'IndexController@sendLoggedInQuote')->name('loggedIn.contact_Seller')->middleware('auth');
Route::post('/send/request-for-quotation', 'IndexController@sendQuote')->name('quote.send')->middleware('auth');
Route::get('/authenticated/user/manage_account', 'UserController@manageBuyerAccount')->name('buyer.manageAccount')->middleware('auth');
Route::post('/authenticated/user/delete/account', 'UserController@deleteBuyerAccount')->name('delete.buyerAccount');


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
    Route::get('/authenticated/admin/profile', 'HomeController@adminProfile')->name('admin.profile');
    Route::get('/authenticated/admin/category', 'CollectionController@category')->name('category');
    Route::post('/authenticated/admin/category/new', 'CollectionController@newCategory')->name('new.category');
    Route::get('/authenticated/admin/category/show', 'CollectionController@getCategory')->name('get.category');
    Route::PUT('/authenticated/admin/category/update', 'CollectionController@updateCategory')->name('update.category');
    Route::DELETE('/authenticated/admin/category/delete', 'CollectionController@deleteCategory')->name('delete.category');

    Route::get('/authenticated/admin/sub_category', 'CollectionController@subcategory')->name('subcategory');
    Route::post('/authenticated/admin/sub_category/new', 'CollectionController@newsubCategory')->name('new.subcategory');
    Route::get('/authenticated/admin/sub_category/show', 'CollectionController@getsubcategory')->name('get.subcategory');
    Route::PUT('/authenticated/admin/sub_category/update', 'CollectionController@updatesubCategory')->name('update.subcategory');
    Route::DELETE('/authenticated/admin/sub_category/delete', 'CollectionController@deletesubCategory')->name('delete.subcategory');

    Route::get('/authenticated/admin/brand', 'CollectionController@brand')->name('brand');
    Route::post('/authenticated/admin/brand/new', 'CollectionController@newbrand')->name('new.brand');
    Route::get('/authenticated/admin/brand/show', 'CollectionController@getbrand')->name('get.brand');
    Route::PUT('/authenticated/admin/brand/update', 'CollectionController@updatebrand')->name('update.brand');
    Route::DELETE('/authenticated/admin/brand/delete', 'CollectionController@deletebrand')->name('delete.brand');

    Route::get('/authenticated/admin/buyer', 'UserController@buyer')->name('buyers');
    Route::get('/authenticated/admin/seller', 'UserController@seller')->name('sellers');
    Route::get('/authenticated/admin/seller/{email}/viewDetails', 'UserController@viewDetails')->name('seller.viewDetails');
    Route::post('/authenticated/admin/block', 'UserController@blockUser')->name('block.user');
    Route::DELETE('/authenticated/admin/delete', 'UserController@deleteUser')->name('delete.user');
    Route::post('/authenticated/admin/verify', 'UserController@verifyUser')->name('verify.profile');

    Route::get('/authenticated/admin/verification/manage', 'VerificationController@manage')->name('verification.manage');
    Route::post('/authenticated/admin/verification/manage/approve', 'VerificationController@approve')->name('verification.approve');
    Route::post('/authenticated/admin/verification/reject', 'VerificationController@reject')->name('verification.reject');

    Route::get('/authenticated/admin/product/manager', 'ProductController@productManager')->name('product.manager');
    Route::post('/authenticated/admin/product/manager/approve', 'ProductController@approve')->name('product.approve');
    Route::post('/authenticated/admin/product/manager/reject', 'ProductController@reject')->name('product.reject');

    Route::get('/authenticated/admin/featured/product/manager', 'FeaturedProductController@productManager')->name('featured_product.manager');
    Route::post('/authenticated/admin/featured/product/manager/approve', 'FeaturedProductController@approve')->name('featured_product.approve');
    Route::post('/authenticated/admin/featured/product/manager/reject', 'FeaturedProductController@reject')->name('featured_product.reject');

    Route::get('/authenticated/admin/hotlist/product/manager', 'HotlistProductController@productManager')->name('hotlist_product.manager');
    Route::post('/authenticated/admin/hotlist/product/manager/approve', 'HotlistProductController@approve')->name('hotlist_product.approve');
    Route::post('/authenticated/admin/hotlist/product/manager/reject', 'HotlistProductController@reject')->name('hotlist_product.reject');

    Route::get('/authenticated/admin/payment/manager', 'PaymentController@index')->name('payment.manager');
    Route::post('/authenticated/admin/payment/manager/refund', 'PaymentController@refund')->name('payment.refund');
    Route::DELETE('/authenticated/admin/payment/manager/delete', 'PaymentController@delete')->name('payment.delete');

    Route::get('/authenticated/admin/premium/members', 'UserController@premiumMembers')->name('premium.members');

    Route::get('/authenticated/users/reviews/all', 'ReviewController@getAllReviews')->name('review.all');
    Route::post('/authenticated/reviews/change/status', 'ReviewController@changeStatus')->name('change.reviewStatus');
    Route::DELETE('/authenticated/reviews/remove', 'ReviewController@delete')->name('review.delete');
});


Route::group(['middleware' => 'App\Http\Middleware\SellerMiddleware'], function() {
    Route::get('/authenticated/user/seller/profile', 'HomeController@sellerProfile')->name('seller.profile');
    Route::post('/authenticated/user/seller/profile/update', 'SellerController@updateSellerProfile')->name('seller.profileUpdate');

    Route::get('/authenticated/user/seller/verification', 'VerificationController@index')->name('verification.index');
    Route::post('/authenticated/user/seller/verification', 'VerificationController@upload')->name('upload.verification');



    Route::get('/authenticated/user/seller/product/new', 'ProductController@index')->name('product.new');
    Route::get('/authenticated/user/seller/product/get/Sub-category-Brand', 'ProductController@getdata')->name('getSubCategoryBrand');
    Route::post('/authenticated/user/seller/product/create', 'ProductController@create')->name('product.create');
    Route::get('/authenticated/user/seller/product/manager', 'ProductController@manage')->name('product.manage');
    Route::get('/authenticated/user/seller/product/manager/edit/{slug}', 'ProductController@editProduct')->name('product.edit');
    Route::put('/authenticated/user/seller/product/manager/update', 'ProductController@updateProduct')->name('product.update');
    Route::DELETE('/authenticated/user/seller/product/manager/delete/takeNote', 'ProductController@deleteProduct')->name('delete_seller.product');
    Route::put('/authenticated/user/seller/product/manager/update/availability', 'ProductController@updateAvailability')->name('update.availability');
    Route::get('/authenticated/user/seller/product/manager/get', 'ProductController@getProduct')->name('get.product');
    Route::get('/authenticated/user/seller/product/manager/get/country', 'ProductController@getCountry')->name('get.country');



    Route::get('/authenticated/user/seller/featured/product/manager', 'FeaturedProductController@manage')->name('featured_product.manage');
    Route::post('/authenticated/user/seller/featured/product/manager/upload_existing_product', 'FeaturedProductController@uploadExistingProduct')->name('upload_existing.featured');
    Route::DELETE('/authenticated/user/seller/featured/product/manager/delete', 'FeaturedProductController@deleteProduct')->name('delete.featuredproduct');
    Route::put('/authenticated/user/seller/featured/product/manager/update/availability', 'FeaturedProductController@updateAvailability')->name('update.featuredavailability');
    Route::get('/authenticated/user/seller/featured/product/manager/edit/{slug}', 'FeaturedProductController@editProduct')->name('featured_product.edit');
    Route::get('/authenticated/user/seller/featured/product/manager/get', 'FeaturedProductController@getProduct')->name('get.Featuredproduct');
    Route::put('/authenticated/user/seller/featured/product/manager/update', 'FeaturedProductController@updateProduct')->name('featured_product.update');



    Route::get('/authenticated/user/seller/hotlist/product/manager', 'HotlistProductController@manage')->name('hotlist_product.manage');
    Route::post('/authenticated/user/seller/hotlist/product/manager/upload_existing_product', 'HotlistProductController@uploadExistingProduct')->name('upload_existing.hotlist');
    Route::DELETE('/authenticated/user/seller/hotlist/product/manager/delete', 'HotlistProductController@deleteProduct')->name('delete.hotlistproduct');
    Route::put('/authenticated/user/seller/hotlist/product/manager/update/availability', 'HotlistProductController@updateAvailability')->name('update.hotlistavailability');
    Route::get('/authenticated/user/seller/hotlist/product/manager/edit/{slug}', 'HotlistProductController@editProduct')->name('hotlist_product.edit');
    Route::get('/authenticated/user/seller/hotlist/product/manager/get', 'HotlistProductController@getProduct')->name('get.hotlistproduct');
    Route::put('/authenticated/user/seller/hotlist/product/manager/update', 'HotlistProductController@updateProduct')->name('hotlist_product.update');


    Route::get('/authenticated/user/seller/buy/economic_package', 'ProductSlotManagerController@index')->name('buy.economic_package');
    Route::post('/authenticated/user/seller/save/economic_package', 'ProductSlotManagerController@saveEconomicPackage')->name('save.economic_package');

    Route::get('/authenticated/user/seller/buy/membership_package', 'MembershipController@membershipIndex')->name('buy.membership_package');
    Route::post('/authenticated/user/seller/save/membership_package', 'MembershipController@saveMembershipPackage')->name('save.membership_package');

    Route::get('/authenticated/user/seller/manage/economic_package', 'ProductSlotManagerController@manageEconomicPackage')->name('manage.economic_package');
    Route::post('/authenticated/user/seller/save/economic_package/renewal', 'ProductSlotManagerController@renewEconomicPackage')->name('renew.economic_package');

    Route::get('/authenticated/user/seller/manager/membership_package', 'MembershipController@manageMembershipPackage')->name('manage.membership_package');
    Route::post('/authenticated/user/seller/save/membership_package/renewal', 'MembershipController@renewMembershipPackage')->name('renew.membership_package');

    Route::get('/authenticated/user/payment/history', 'PaymentController@history')->name('payment.history');
    Route::get('/authenticated/sellers/user/reviews', 'ReviewController@getMyReviews')->name('review.seller');

    Route::get('/authenticated/user/seller/manage_account', 'UserController@manageAccount')->name('seller.manageAccount');
    Route::post('/authenticated/user/seller/delete/account', 'UserController@deleteSellerAccount')->name('delete.sellerAccount');






});
