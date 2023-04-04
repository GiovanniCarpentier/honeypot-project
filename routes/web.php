<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUpload;
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

Route::get('/', function () {
    return view('landingpage');
});

Route::get("/shop", [ShopController::class, "shop"])->name("shop");

Route::get('/shop/{name}', [ShopController::class, 'getItems']);

Route::get('/winniethepooh', function () {
    return view("winniethepooh");
});


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/users/block/{id}',[UserController::class, 'block'])->name("blockUser");
    Route::get('/users/unblock/{id}',[UserController::class, 'unblock'])->name("unblockUser");
    Route::resource('products', ProductController::class);
});

Auth::routes();

Route::get('/dashboard',function () {
    return view("shop");
});;

Route::get('/spongebobmeboi', function () {
    return view('spongebobmeboi');
});

Route::get('/axwvomjwjumjwq', function() {
    return view('noice');
});

Route::get('/upload-file', [FileUpload::class, 'createForm'])->middleware('auth');

Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');

Route::get('/broken', function() {
    return view('broken');
});

Route::get('/brokenuser', function() {
    return view('brokenuser');
});
