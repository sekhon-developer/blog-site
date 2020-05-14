<?php
use Illuminate\Support\Facades\Route;

/* Admin */
Route::get('/admin/index', function () { return view('admin.index'); });

/* Manage categories */
Route::get('/admin/manage-categories', function () { return view('admin.manage-categories'); });
Route::get('/admin/add-category', function () { return view('admin.add-category'); });
Route::post('/add-category', 'categoryController@add');

Route::get('/admin/update-category/{category}', function ($category) { return view('admin.update-category', ['category' => $category]); });
Route::post('/update-category', 'categoryController@update');
Route::post('/delete-category', 'categoryController@delete');

/* Manage blogs */
Route::get('/admin/manage-blogs', function () { return view('admin.manage-blogs'); });
Route::get('/admin/add-blog', function () { return view('admin.add-blog'); });
Route::post('/add-blog', 'blogController@add');
Route::get('/admin/update-blog/{blog}', function ($blog) { return view('admin.update-blog', ['blog' => $blog]); });
Route::post('/update-blog', 'blogController@update');
Route::post('/delete-blog', 'blogController@delete');

/* Admin authentication and profile */
Route::get('/admin/sign-in', function () { return view('admin.auth.sign-in'); });
Route::post('/admin-sign-in', 'authController@admin_sign_in');
Route::get('/admin-sign-out', 'authController@admin_sign_out');
Route::get('/admin/profile', function(){ return view('admin.profile'); });
Route::post('/update-admin-profile', 'profileController@update_admin_profile');
Route::get('/admin/update-password', function(){ return view('admin.update-password'); });
Route::post('/update-admin-password', 'profileController@update_admin_password');


/* User */
/* Authentication and profile */
Route::get('/sign-in', function(){ return view('user.auth.sign-in'); });
Route::post('/sign-in', 'authController@sign_in');
Route::get('/sign-up', function(){ return view('user.auth.sign-up'); });
Route::post('/sign-up', 'authController@sign_up');
Route::get('/sign-out', 'authController@sign_out');


/* Home page */
Route::get('/', function () { return view('user.index'); });


Route::post('/report-blog', 'reportController@report_blog');
Route::post('/add-to-favourite', 'favouriteController@add');
Route::post('/remove-favourite', 'favouriteController@delete');
Route::post('/like-blog', 'blogController@like');
Route::post('/unlike-blog', 'blogController@unlike');
Route::post('/dislike-blog', 'blogController@dislike');
Route::post('/undislike-blog', 'blogController@undislike');

/* Contact Us */
Route::get('/contact-us', function(){ return view('user.contact-us'); });

/* About us */
Route::get('/about-us', function(){ return view('user.about-us'); });

/* Search */
Route::get('/search', function(){ return view('user.search'); });