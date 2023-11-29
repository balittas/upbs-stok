<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserDetailController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::post('/ongkir', [CheckOngkirController::class, 'check_ongkir']);
Route::get('/cities/{province_id}', [CheckOngkirController::class, 'getCities']);

Route::get('/', [ProductsController::class, 'index'])->name('pengguna.index');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::get('/filter_product', [ProductsController::class, 'filter_product'])->name('filter_product');
Route::resources([
    'produk' => ProductsController::class,
    'keranjang' => CartsController::class,
    'checkout' => CheckoutController::class,
    'transaksi' => TransaksiController::class,
]);

Route::middleware(['auth:sanctum', 'verified', 'can:admin'])->group(function () {
    Route::prefix('admin-page')->group(function () {
        Route::get('/home', [ProductController::class, 'index'])->name('admin.index');
        Route::resources([
            'product' => ProductController::class,
            'detail-product' => DetailProductController::class,
            'product-category' => ProductCategoryController::class,
            'transaction' => TransactionController::class,
            'cart' => CartController::class,
            'user' => UserController::class,
            'dashboard' => DashboardController::class,
            // 'transaction-export' => TransactionController::class,
        ]);
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transaction/export', [App\Http\Controllers\Admin\TransactionController::class, 'export_excel'])->name('index');
