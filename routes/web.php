<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductPropertyController;
use App\Http\Controllers\ContentManagerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMediaFileController;
use App\Http\Controllers\ProductPropertyController;
use App\Http\Controllers\ProductPropertyTypeController;
use App\Http\Controllers\UserOrderStatusController;
use App\Http\Middleware\EnsureUserHasRightToGetToTheCRUD;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsAuthorized;
use App\Http\Middleware\EnsureUserIsNotAuthorized;
use Illuminate\Support\Facades\Route;


// Общие маршруты
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/catalog', [MainController::class, 'catalog'])->name('catalog');
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::get('/category/{category}', [MainController::class, 'category'])->name('category');
Route::get('/product/{product}', [MainController::class, 'product'])->name('product');


// Регистрация и авторизация
Route::middleware(EnsureUserIsNotAuthorized::class)->prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginHandler');
    Route::get('/registration', [AuthController::class, 'registerPage'])->name('registration');
    Route::post('/registration', [AuthController::class, 'register'])->name('registrationHandler');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Авторизованный пользователь
Route::middleware(EnsureUserIsAuthorized::class)->prefix('me')->group(function () {
    Route::get('/favorite', [MainController::class, 'favorite'])->name('user.favorite');
    Route::post('/product/{product}/add-to-favorite', [FavoriteController::class, 'addToFavorite'])->name('user.add-to-favorite');
    Route::post('/product/{product}/remove-from-favorite/{userFavoriteItem}', [FavoriteController::class, 'removeFromFavorite'])->name('user.remove-from-favorite');
    Route::get('/cart', [MainController::class, 'cart'])->name('user.cart');
    Route::post('/product/{product}/add-to-cart', [CartController::class, 'addToCart'])->name('user.add-to-cart');
    Route::post('/product/{product}/remove-from-cart/{userCartItem}', [CartController::class, 'removeFromCart'])->name('user.remove-from-cart');
    Route::post('/product/{product}/set-count-of-cart-item/{userCartItem}', [CartController::class, 'setProductCount'])->name('user.set-count-of-cart-item');
    Route::get('/orders', [MainController::class, 'orders'])->name('user.orders');
    Route::post('/make-order', [OrderController::class, 'store'])->name('user.make-order');
    Route::post('/product/{product}/make-comment', [MainController::class, 'makeComment'])->name('user.make-comment');
});


// CRUD для контент-менеджера
Route::middleware(EnsureUserHasRightToGetToTheCRUD::class)->prefix('/crud')->group(function () {

    // Главная страница контент-менеджера
    Route::get('/', [ContentManagerController::class, 'index'])->name('crud.index');

    // Категории
    Route::resource('categories', CategoryController::class);

    // Типы свойств продуктов
    Route::resource('product-property-types', ProductPropertyTypeController::class);

    // Свойства для продуктов этой категории
    Route::resource('categories/{category}/category-product-properties', CategoryProductPropertyController::class);

    // Продукты
    Route::resource('products', ProductController::class);

    // Изображения продуктов
    Route::resource('products/{product}/product-media-files', ProductMediaFileController::class);

    // Свойства продуктов
    Route::resource('products/{product}/product-properties', ProductPropertyController::class);

});


// Администратор
Route::middleware(EnsureUserIsAdmin::class)->prefix('/admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Статусы заказов пользователей
    Route::resource('user-order-statuses', UserOrderStatusController::class);

    // Пользователи
    Route::get('/users', [AdminController::class, 'usersList'])->name('admin.users.index');

    // Заказы пользователей
    Route::get('/user-orders', [AdminController::class, 'userOrdersList'])->name('admin.user-orders.index');
    Route::post('/user-orders/{userOrder}/status-update', [OrderController::class, 'statusUpdate'])->name('admin.user-orders.order-status-update');
    Route::get('/user-orders/{userOrder}', [OrderController::class, 'orderItemsList'])->name('admin.user-orders.order-items');

});





