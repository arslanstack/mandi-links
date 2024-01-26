<?php
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductPostController;
use App\Http\Controllers\Admin\ProductRequestController;
use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin'], function () {
	Route::get('login', [AdminLoginController::class, 'index'])->name('login');
	Route::post('verify_login', [AdminLoginController::class, 'verify_login']);
	Route::get('logout', [AdminLoginController::class, 'logout']);

	Route::group(['middleware' => ['auth:admin']], function () {

		Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
		Route::get('admin', [AdminController::class, 'index']);
		Route::get('change_password', [AdminController::class, 'change_password']);
		Route::post('update_password', [AdminController::class, 'update_password']);

		Route::group(['prefix'  =>  'users'], function () {
			Route::get('/', [UserController::class, 'index']);
			Route::post('update_statuses', [UserController::class, 'update_statuses']);
			Route::get('detail/{id}', [UserController::class, 'user_details']);
		});

		Route::group(['prefix'  =>  'categories'], function () {
			Route::get('/', [CategoryController::class, 'index']);
			Route::post('store', [CategoryController::class, 'store_category']);
			Route::post('delete-category', [CategoryController::class, 'delete_category']);
			Route::post('category-show', [CategoryController::class, 'category_show']);
			Route::post('update-category', [CategoryController::class, 'update_category']);
		});

		Route::group(['prefix'  =>  'product-posts'], function () {
			Route::get('/', [ProductPostController::class, 'index']);
			Route::post('update_statuses', [ProductPostController::class, 'update_statuses']);
			Route::get('detail/{id}', [ProductPostController::class, 'post_details']);
		});
		Route::group(['prefix'  =>  'product-requests'], function () {
			Route::get('/', [ProductRequestController::class, 'index']);
			Route::post('update_statuses', [ProductRequestController::class, 'update_statuses']);
			Route::get('detail/{id}', [ProductRequestController::class, 'prod_req_details']);
		});

		Route::group(['prefix'  =>  'blogs'], function () {
			Route::get('/', [BlogController::class, 'index']);
			Route::get('add', [BlogController::class, 'add_blog']);
			Route::post('store', [BlogController::class, 'store_blog']);
			Route::post('delete-blog', [BlogController::class, 'delete_blog']);
			Route::get('blog-show/{id}', [BlogController::class, 'blog_show']);
			Route::post('update-blog', [BlogController::class, 'update_blog']);
		});
	});
});