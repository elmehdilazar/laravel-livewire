<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
//sort order
   $contacts = Contact::all();
   $collectons=collect($contacts);
//dd($collectons->sortBy('name')->values()->all());
dd($collectons->sortByDesc('name')->values()->all());





});
Route::get('/auth', function () {

    return view('auth');
});
