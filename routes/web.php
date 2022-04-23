<?php

use App\Http\Cinetpay ;
use Illuminate\Http\Request;
use App\Http\Livewire\CartComponent;

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\AboutComponent;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\CinetPayController;
use App\Http\Livewire\CpPaymentFailComponent;
use App\Http\Livewire\CpPaymentSuccessComponent;

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

Route::get('/', HomeComponent::class)->name("home");

Route::get('/clear', function(){
    Cart::destroy();

    return redirect()->back();
});

Route::get('/cart', CartComponent::class)->name("cart");

Route::get('/cart/remove', function(Request $request){
    Cart::remove($request->rowId);
    session()->flash('success_message', "Produit supprimé !");
    return redirect()->back();
})->name("cart.remove");

Route::get('/add-to-cart', function(Request $request){
    // dd($request->all());
    Cart::add((int)$request->product_id,$request->product_name, 1, (int)$request->product_price)->associate("App\models\Product");
    session()->flash('success_message', "Produit ajouté au panier !");
    return redirect()->route('home');
})->name("cart.add");

Route::post('/checkout', [CinetPayController::class, 'checkout'])->name("checkout");

Route::get('/notify_url', [CinetPayController::class, 'notify'])->name("cp.notify_url");

Route::post('/return_url', [CinetPayController::class, 'return'])->name("cp.return_url");

Route::get('/cp_payment_success', CpPaymentSuccessComponent::class)->name("cp.payment_sucess");
Route::get('/cp_payment_fail', CpPaymentFailComponent::class)->name("cp.payment_fail");

Route::get('/about', AboutComponent::class)->name("about");

