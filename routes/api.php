<?php

use Illuminate\Http\Request;

/**
 * Party Layer == >Third< Party Layer that is controlled for all users.
 */
// Fetch all entities within your DocumentSchema
Route::get('/{token}','PartyLayerController@parseGet');

// Create a new DocumentEntity
Route::post('/{token}','PartyLayerController@parsePost');

// Find BY query.
Route::get('/{token}/{unique}/{query}','PartyLayerController@parseViaUnique');

// Update BY query.
Route::put('/{token}/{unique}/{query}','PartyLayerController@updateViaUnique');
Route::patch('/{token}/{unique}/{query}','PartyLayerController@updateViaUnique');

// Remove BY query.
Route::delete('/{token}/{unique}/{query}','PartyLayerController@deleteViaUnique');