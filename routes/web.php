<?php

use App\Http\Controllers\WalksController;
use App\Http\Resources\DogResource;
use App\Models\DogOwners;
use App\Models\Dogs;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('walks', WalksController::class);

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