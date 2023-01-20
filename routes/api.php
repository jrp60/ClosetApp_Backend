<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutfitController;
use App\Http\Controllers\UserOutfitController;
use App\Http\Controllers\Auth\LoginController;
//sanctum
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', function(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->email)->plainTextToken;
});


// Route::get('outfits', OutfitController::class . '@index');
Route::post('login', [LoginController::class, 'login']);

// Router::group(['middleware' => ['web']], function () {
//     Route::get('outfits', OutfitController::class . '@index');
//     Route::post('login', [LoginController::class, 'login']);
// });


//Auth sanctum
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('outfits', OutfitController::class . '@index');
    Route::post('outfits', [OutfitController::class, 'postCreate']);
    Route::put('outfits/{userId}{qtty}', [OutfitController::class, 'putLikes']);
    Route::post('user_outfit/{userId}{outfitId}', [UserOutfitController::class, 'postCreate']);
    Route::put('user_outfit/{userId}{outfitId}', [UserOutfitController::class, 'putChangelike']);
    Route::get('user_outfit/{userId}{outfitId}', [UserOutfitController::class, 'getLiked']);
});
