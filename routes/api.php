<?php

use Illuminate\Http\Request;

Route::get('/{token}','PartyLayerController@parseGet');
Route::get('/{token}/{unique}/{query}','PartyLayerController@parseViaUnique');