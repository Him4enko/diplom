<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
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

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::group(['middleware' => 'firewall.all'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/catalog', [FrontController::class, 'catalog'])->name('front.catalog');
    Route::get('/categories', [FrontController::class, 'categories'])->name('front.categories');
    Route::get('/categorie/{slug}', [FrontController::class, 'categoryPage'])->name('front.categoryPage');
    Route::get('/categories/{slug}', [FrontController::class, 'subcategoryPage'])->name('front.subcategoryPage');
    Route::get('/marques', [FrontController::class, 'brands'])->name('front.brands');
    Route::get('/marque/{slug}', [FrontController::class, 'brandPage'])->name('front.brandPage');
    Route::get('/catalog/{slug}', [FrontController::class, 'productShow'])->name('front.product');
    Route::get('/panier', [FrontController::class, 'cart'])->name('front.cart');
    Route::get('/caisse', [FrontController::class, 'checkout'])->name('front.checkout');
    Route::get('/merci-pour-votre-commande/{order}', [FrontController::class, 'thankyou'])->name('front.thankyou');
    Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
    Route::get('/a-propos', [FrontController::class, 'about'])->name('front.about');
    Route::get('/blog', [FrontController::class, 'blog'])->name('front.blog');
    Route::get('/blog/{slug}', [FrontController::class, 'blogPage'])->name('front.blogPage');
    Route::get('/page/{slug}', [FrontController::class, 'dynamicPage'])->name('front.dynamicPage');
    Route::get('/generate-sitemap', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');

    Route::get('/paypal/cancel', function () {
        return redirect()->route('front.checkout');
    })->name('paypal.cancel');
    Route::get('/paypal/success', function () {
        $this->checkout();
        return redirect()->route('front.thankyou');
    })->name('paypal.success');

    Route::middleware('auth')->group(function () {
        Route::get('/mon-compte', [FrontController::class, 'myaccount'])->name('front.myaccount');
    });

    Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');
});

Route::fallback(function (Request $request) {
    return app()->make(ErrorController::class)->notFound($request);
});
