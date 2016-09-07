<?php

use Illuminate\Http\Request;

/**
 * Party Layer == >Third< Party Layer that is controlled for all users.
 */
Route::get('/{token}','PartyLayerController@parseGet');
Route::post('/{token}','PartyLayerController@parsePost');
Route::get('/{token}/{unique}/{query}','PartyLayerController@parseViaUnique');
Route::put('/{token}/{unique}/{query}','PartyLayerController@updateViaUnique');
Route::patch('/{token}/{unique}/{query}','PartyLayerController@updateViaUnique');
Route::delete('/{token}/{unique}/{query}','PartyLayerController@deleteViaUnique');