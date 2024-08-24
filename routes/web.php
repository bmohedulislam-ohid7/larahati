<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\TestmonialController;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\SslCommerzPaymentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//SliderController
Route::get('slider', [SliderController::class, 'slider'])->name('slider');
Route::post('slider/post', [SliderController::class, 'sliderpost'])->name('sliderpost');
Route::get('slider/delete/{slider_id}', [SliderController::class, 'sliderdelete'])->name('sliderdelete');
Route::get('slider/all/delete', [SliderController::class, 'slideralldelete'])->name('slideralldelete');
Route::get('slider/edit/{slider_id}', [SliderController::class, 'slideredit'])->name('slideredit');
Route::post('slider/edit/post/{slider_id}', [SliderController::class, 'slidereditpost'])->name('slidereditpost');
Route::get('slider/restore/{slider_id}', [SliderController::class, 'sliderrestore'])->name('sliderrestore');
Route::get('slider/force/delete/{slider_id}', [SliderController::class, 'sliderforcedelete'])->name('sliderforcedelete');
Route::get('slider/all/restore', [SliderController::class, 'sliderallrestore'])->name('sliderallrestore');

//FrontendController
Route::get('/', [FrontendController::class, 'home'])->name('tohoney_home');
Route::get('about', [FrontendController::class, 'about'])->name('about');
Route::get('contac', [FrontendController::class, 'contact'])->name('contact');
Route::get('product/detailes/{product_id}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('categorywise/shop/{category_id}', [FrontendController::class, 'categorywiseshop'])->name('categorywiseshop');
Route::post('update/cart', [FrontendController::class, 'updatecart'])->name('updatecart');
Route::get('cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('cart/{coupon_name}', [FrontendController::class, 'cart'])->name('cartwithcoupon');
Route::get('checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('checkout/post', [FrontendController::class, 'checkoutpost'])->name('checkoutpost');
Route::get('customer/register', [FrontendController::class, 'customerregister'])->name('customerregister');
Route::post('customer/register/post', [FrontendController::class, 'customerregisterpost'])->name('customerregisterpost');
Route::get('customer/login', [FrontendController::class, 'customerlogin'])->name('customerlogin');
Route::post('customer/login/post', [FrontendController::class, 'customerloginpost'])->name('customerloginpost');
Route::post('get/city/list', [FrontendController::class, 'getcitylist']);
Route::get('search', [FrontendController::class, 'search']);
Route::get('blog/page', [FrontendController::class, 'blogpage'])->name('blogpage');

//HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('download/invoice/{order_id}', [HomeController::class, 'downloadinvoice'])->name('downloadinvoice');
Route::get('give/review/{order_id}', [HomeController::class, 'givereview'])->name('givereview');
Route::post('review/post/{order_details_id}', [HomeController::class, 'reviewpost'])->name('reviewpost');


//CategoryController
Route::get('category', [CategoryController::class, 'category'])->name('category')->middleware('role');
Route::post('category/post', [CategoryController::class, 'categorypost'])->name('categorypost');
Route::get('category/edit/{category_id}', [CategoryController::class, 'categoryedit'])->name('categoryedit');
Route::post('category/edit/post', [CategoryController::class, 'categoryeditpost'])->name('categoryeditpost');
Route::get('category/delete/{category_id}', [CategoryController::class, 'categorydelete'])->name('categorydelete');
Route::get('category/all/delete', [CategoryController::class, 'categoryalldelete'])->name('categoryalldelete');
Route::get('category/restore/{category_id}', [CategoryController::class, 'categoryrestore'])->name('categoryrestore');
Route::get('category/force/delete/{category_id}', [CategoryController::class, 'categoryc'])->name('categoryforcedelete');
Route::get('category/all/restore', [CategoryController::class, 'categoryallrestore'])->name('categoryallrestore');

//ProductController
Route::get('product', [ProductController::class, 'product'])->name('product')->middleware('role');
Route::post('product/post', [ProductController::class, 'productpost'])->name('productpost');
Route::get('product/edit/{product_id}', [ProductController::class, 'productedit'])->name('productedit');
Route::post('product/edit/post/{product_id}', [ProductController::class, 'producteditpost'])->name('producteditpost');
Route::get('product/delete/{product_id}', [ProductController::class, 'productdelete'])->name('productdelete');
Route::get('product/all/delete', [ProductController::class, 'productalldelete'])->name('productalldelete');
Route::get('product/all/restore', [ProductController::class, 'productallrestore'])->name('productallrestore');
Route::get('product/restore/{product_id}', [ProductController::class, 'productrestore'])->name('productrestore');
Route::get('product/force/delete/{product_id}', [ProductController::class, 'productforcedelete'])->name('productforcedelete');

//SettingController
Route::get('setting', [SettingController::class, 'setting'])->name('setting')->middleware('role');
Route::post('setting/post', [SettingController::class, 'settingpost'])->name('settingpost');

//TestmonialController
Route::get('testmonial', [TestmonialController::class, 'testmonial'])->name('testmonial');
Route::post('testmonial/post', [TestmonialController::class, 'testmonialpost'])->name('testmonialpost');
Route::get('testmonial/delete/{testmonial_id}', [TestmonialController::class, 'testmonialdelete'])->name('testmonialdelete');
Route::get('testmonial/edit/{testmonial_id}', [TestmonialController::class, 'testmonialedit'])->name('testmonialedit');
Route::post('testmonial/edit/post/{testmonial_id}', [TestmonialController::class, 'testmonialeditpost'])->name('testmonialeditpost');
Route::get('testmonial/restore/{testmonial_id}', [TestmonialController::class, 'testmonialrestore'])->name('testmonialrestore');
Route::get('testmonial/force/{testmonial_id}', [TestmonialController::class, 'testmonialforcedelete'])->name('testmonialforcedelete');
Route::get('testmonial/all/delete', [TestmonialController::class, 'testmonialalldelete'])->name('testmonialalldelete');
Route::get('testmonial/all/restore', [TestmonialController::class, 'testmonialallrestore'])->name('testmonialallrestore');

//BlogController
Route::get('blog', [BlogController::class, 'blog'])->name('blog');
Route::post('blog/post', [BlogController::class, 'blogpost'])->name('blogpost');
Route::get('blog/delete/{bloginfo_id}', [BlogController::class, 'blogdelete'])->name('blogdelete');
Route::get('blog/edit/{bloginfo_id}', [BlogController::class, 'blogedit'])->name('blogedit');
Route::post('blog/edit/post/{bloginfo_id}', [BlogController::class, 'blogeditpost'])->name('blogeditpost');
Route::get('blog/restore/{bloginfo_id}', [BlogController::class, 'blogrestore'])->name('blogrestore');
Route::get('blog/force/delete/{bloginfo_id}', [BlogController::class, 'blogforcedelete'])->name('blogforcedelete');
Route::get('blog/all/restore', [BlogController::class, 'blogallrestore'])->name('blogallrestore');
Route::get('blog/all/delete', [BlogController::class, 'blogalldelete'])->name('blogalldelete');

//CartController
Route::post('add/to/cart/{product_id}', [CartController::class, 'addtocart'])->name('addtocart');
Route::get('cart/delete/{cart_id}', [CartController::class, 'cartdelete'])->name('cartdelete');

//CouponController
//Route::get('coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::resource('coupon',CouponController::class)->middleware('role');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/online/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

