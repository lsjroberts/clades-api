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
| Organisms
|--------------------------------------------------------------------------
|
| ...
|
*/

// Create
Route::post('/organisms', [
    'as' => 'organisms.create',
    'uses' => 'Clades\Organisms\OrganismsController@create'
]);

// Read
Route::get('/organisms/{id}', [
    'as' => 'organisms.show',
    'uses' => 'Clades\Organisms\OrganismsController@show'
])
->where('id', '[0-9]+');

// Update
Route::put('/organisms/{id}', [
    'as' => 'organisms.update',
    'uses' => 'Clades\Organisms\OrganismsController@update'
])
->where('id', '[0-9]+');

// Delete
Route::delete('/organisms/{id}', [
    'as' => 'organisms.delete',
    'before' => 'auth',
    'uses' => 'Clades\Organisms\OrganismsController@delete'
])
->where('id', '[0-9]+');

// List
Route::get('/organisms', [
    'as' => 'organisms.index',
    'uses' => 'Clades\Organisms\OrganismsController@index'
]);


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
Route::get('/clades/{id}', [
    'as' => 'clades.show',
    'uses' => 'Clades\CladesController@show'
]);

// Update
Route::put('/clades/{id}', 'Clades\CladesController@update');

// Delete
Route::delete('/clades/{id}', [
    'before' => 'auth',
    'uses' => 'Clades\CladesController@delete'
]);

// List
Route::get('/clades', 'Clades\CladesController@list');

