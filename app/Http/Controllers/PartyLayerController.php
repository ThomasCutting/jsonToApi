<?php

namespace App\Http\Controllers;

use App\DocumentEntity;
use App\DocumentSchema;
use App\Providers\DocumentServiceProvider;
use Illuminate\Http\Request;

use App\Http\Requests;

class PartyLayerController extends Controller
{
    public function parseGet($token)
    {
        return $this->returnEntriesOrFail($token);
    }

    public function parseViaUnique($token, $unique_key, $query)
    {
        return $this->returnViaTokenAndUnique($token, $unique_key, $query);
    }

    private function returnViaTokenAndUnique($token, $unique_key, $query)
    {
        if(DocumentSchema::whereToken($token)->exists()) {
            return (new DocumentServiceProvider(DocumentSchema::whereToken($token)->first()))->retrieveEntitiesByUnique($unique_key, $query);
        } else {
            return [
                "model does not exist"
            ];
        }
    }

    private function returnEntriesOrFail($token)
    {
        // If the documentSchema exists, with the provided token.
        if (DocumentSchema::whereToken($token)->exists()) {
            // Return the entities.
            return (new DocumentServiceProvider(DocumentSchema::whereToken($token)->first()))->retrieveEntities();
        } else {
            // Return message, that does not function?..
            return [
                "model does not exist"
            ];
        }
    }
}
