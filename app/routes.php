<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return 'Clades';
});


/*
|--------------------------------------------------------------------------
| Clades
|--------------------------------------------------------------------------
|
| ...
|
*/

// Create
Route::post('/clades', 'Clades\CladesController@create');

// Read
Route::get('/clades/{id}', 'Clades\CladesController@show');

// Update
Route::put('/clades/{id}', 'Clades\CladesController@update');

// Delete
Route::delete('/clades/{id}', [
    'before' => 'auth',
    'uses' => 'Clades\CladesController@delete'
]);

// List
Route::get('/clades', 'Clades\CladesController@list');

