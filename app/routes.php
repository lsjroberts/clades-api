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
| Taxa
|--------------------------------------------------------------------------
|
|
|
*/

// Show
Route::get('/taxa/{id}', [
    'as' => 'taxa.show',
    'uses' => 'Clades\Taxa\TaxaController@show'
]);

// List
Route::get('/taxa', [
    'as' => 'taxa.index',
    'uses' => 'Clades\Taxa\TaxaController@index'
]);

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

// Read
Route::get('/organisms/{id}/clade', [
    'as' => 'clades.show',
    'uses' => 'Clades\CladesController@show'
]);
