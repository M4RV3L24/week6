<?php

use App\Models\Dogs;
use App\Models\DogOwners;
use App\Http\Resources\DogResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WalksController;

/**
 * List website urls
 */
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('walks', WalksController::class)->middleware('role:admin');

/**
 * List Dogs API without Authentication
 * http://localhost:8000/dogs/owner/1
 */
Route::get('/dogs/owner/{idowner}', function (string $idowner) {
    // Query from code below :
    // select distinct dog_id from `dog_owner` where `owner_id` = $idowner group by `dog_id`;
    // Ambil list distinct dog id dari tabel dog_owner (Tidak ada yang kembar), kemudian query ke table dog untuk ambil data anjing
    $idList = DogOwners::distinct('dog_id')
                        ->where('owner_id', $idowner)
                        ->groupBy('dog_id')
                        ->get('dog_id');
    return DogResource::collection(Dogs::query()->whereIn('id', $idList)->get());
});