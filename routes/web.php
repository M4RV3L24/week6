<?php

use App\Http\Controllers\WalksController;
use App\Http\Resources\DogResource;
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
    return DogResource::collection(Dogs::query()->leftJoin('dog_owner', 'dogs.id', '=', 'dog_owner.dog_id')->where('dog_owner.owner_id', $idowner)->get())->response();
});