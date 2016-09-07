<?php

namespace App\Http\Controllers;

use App\DocumentEntity;
use App\DocumentEntityPoint;
use App\DocumentSchema;
use App\DocumentSchemaPoint;
use App\Providers\DocumentServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class WebController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function buildApiFunnel()
    {
        $json = json_decode(Input::get('jsonField'),1);
        if(is_array($json)) {

            // Generate the Schema!

            $documentSchema = new DocumentSchema();
            $documentSchema->token = sha1(time().md5(rand(0,50353)));
            $documentSchema->name = "Created at " . Carbon::now()->toDateTimeString();
            $documentSchema->owner_id = 0;
            $documentSchema->save();

            $helper = new DocumentServiceProvider($documentSchema);

            foreach($json as $item => $value) {
                $pointType = $this->generatePointType($helper->retrieveTypeOfValue($value));
                $documentSchemaPoint = new DocumentSchemaPoint();
                $documentSchemaPoint->name = $item;
                $documentSchemaPoint->schema_id = $documentSchema->id;
                $documentSchemaPoint->type_id = $pointType->id;
                $documentSchemaPoint->value_id = 0;
                $documentSchemaPoint->save();
            }

            // Generate the Entities!

            $documentEntity = new DocumentEntity();
            $documentEntity->schema_id = $documentSchema->id;
            $documentEntity->save();

            foreach($json as $item => $value) {
                $documentEntityPoint = new DocumentEntityPoint();
                $documentEntityPoint->id = rand(rand(0,50),50000);
                $tempPair = $this->generatePointValuePair($helper->retrieveTypeOfValue($value), $value, $documentEntityPoint->id);
                $documentEntityPoint->name = $item;
                $documentEntityPoint->entity_id = $documentEntity->id;
                $documentEntityPoint->type_id = $tempPair["type"]->id;
                $documentEntityPoint->value_id = $tempPair["value"]->id;
                $documentEntityPoint->save();
            }

            //

            return redirect('/?token='.$documentSchema->token);
        } else {
            return redirect('/');
        }
    }

    private function generatePointType($type)
    {
        $pointType = new \App\PointType();
        switch ($type) {
            case "json":
                $pointType->type_name = "json";
                break;
            case "boolean":
            case "bool":
                $pointType->type_name = "boolean";
                break;
            case "integer":
            case "int":
                $pointType->type_name = "integer";
                break;
            case "float":
                $pointType->type_name = "float";
                break;
            case "string":
                $pointType->type_name = "string";
                break;
            case "datetime":
            case "date":
            case "time":
                $pointType->type_name = "datetime";
                break;
        }
        $pointType->default_value_id = 0;
        $pointType->save();
        return $pointType;
    }

    private function generatePointValuePair($type, $type_value, $point_id = 0)
    {
        // Create a new PointType, and PointValue.
        $pointType = new \App\PointType();
        $pointValue = new \App\PointVaule();

        $pointValue->point_id = $point_id;

        switch ($type) {
            case "json":
                $pointType->type_name = "json";
                $pointValue->json_value = json_encode($type_value);
                break;
            case "boolean":
            case "bool":
                $pointType->type_name = "boolean";
                $pointValue->boolean_value = $type_value;
                break;
            case "integer":
            case "int":
                $pointType->type_name = "integer";
                $pointValue->integer_value = $type_value;
                break;
            case "float":
                $pointType->type_name = "float";
                $pointValue->float_value = $type_value;
                break;
            case "string":
                $pointType->type_name = "string";
                $pointValue->string_value = ("" . $type_value);
                break;
            case "datetime":
            case "date":
            case "time":
                $pointType->type_name = "datetime";
                $pointValue->datetime_value = $type_value;
                break;
        }

        $pointType->default_value_id = 0;
        $pointType->save();
        $pointValue->save();

        return [
            "type" => $pointType,
            "value" => $pointValue
        ];
    }
}
