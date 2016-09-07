<?php

namespace App\Providers;

use App\DocumentEntity;
use App\DocumentEntityPoint;
use App\DocumentSchema;
use App\PointType;
use App\PointVaule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class DocumentServiceProvider
{
    protected $schema;

    /**
     * DocumentServiceProvider constructor.
     * @param DocumentSchema $schema
     */
    public function __construct(DocumentSchema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * Create a new document entity.
     *
     * @return array
     */
    public function createEntry()
    {
        // We're going to (presume) :\ that all input is valid and cleaned.
        $input = Input::all();

        $documentEntity = new DocumentEntity();
        $documentEntity->schema_id = $this->schema->id;
        $documentEntity->save();

        foreach($input as $key => $value) {
            $documentEntityPoint = new DocumentEntityPoint();
            $documentEntityPoint->entity_id = $documentEntity->id;
            $documentEntityPoint->id = rand(rand(0,50),50000);
            $documentEntityPoint->name = $key;

            $pointType = new PointType();
            $pointType->type_name = $this->retrieveTypeOfValue($value);
            $pointType->default_value_id = 0;
            $pointType->save();

            $pointValue = new PointVaule();
            $pointValue->point_id = $documentEntityPoint->id;

            if($pointType->type_name!="json") {
                $pointValue[$pointType->type_name . "_value"] = $value;
            } else {
                $pointValue[$pointType->type_name . "_value"] = json_encode($value);
            }

            $pointValue->save();

            $documentEntityPoint->type_id = $pointType->id;
            $documentEntityPoint->value_id = $pointValue->id;

            $documentEntityPoint->save();
        }

        return [
            "success" => true
        ];
    }

    /**
     * Retrieve the type of value.
     *
     * @param $value
     * @return string
     */
    private function retrieveTypeOfValue($value)
    {
        if(is_array($value)) {
            return "json";
        } else if(is_integer($value)) {
            return "integer";
        } else if(is_string($value)) {
            return "string";
        } else if(is_bool($value)) {
            return "boolean";
        } else if(is_float($value)) {
            return "float";
        } else if((Carbon::parse($value))) {
            return "datetime";
        }
    }


    /**
     * Retrieve unique entities with a query.
     *
     * @param $unique_key
     * @param $query
     * @return mixed
     */
    public function retrieveEntitiesByUnique($unique_key, $query)
    {
        $entities = $this->retrieveEntities();
        $resArr = [];

        foreach($entities as $entity) {
            if($entity[$unique_key] == $query) {
                $resArr[] = $entity;
            }
        }

        if(count($resArr)==1) {
            return $resArr[0];
        } else {
            return $resArr;
        }
    }

    public function updateEntriesByUnique($unique_key, $query)
    {
        // Pull all entries..
        $entities = $this->retrieveEntitiesWithBacktrackId();

        // Retrieve all input.
        $input = Input::all();

        $resArr = [];

        foreach($entities as $entity) {
            if($entity[$unique_key] == $query) {
                $resArr[] = $entity;
            }
        }

        foreach($resArr as $item) {
            $points = DocumentEntityPoint::whereEntityId($item["entity_id"])->get();

            foreach($points as $point) {
                foreach($input as $item => $value) {
                    if ($point->name == $item) {
                        PointVaule::whereId($point->value_id)->update([
                            $this->retrieveTypeOfValue($value)."_value" => $this->safelyInsertValue($value)
                        ]);
                        PointType::whereId($point->type_id)->update([
                            "type_name" => $this->retrieveTypeOfValue($value)
                        ]);
                    }
                }
            }
        }

        return [
            "success" => true
        ];
    }

    private function safelyInsertValue($value)
    {
        if($this->retrieveTypeOfValue($value) == 'json') {
            return json_encode($value);
        } else {
            return $value;
        }
    }

    /**
     * Remove entities by a unique key and query.
     *
     * @param $unique_key
     * @param $query
     * @return array
     */
    public function removeEntitiesByUnique($unique_key, $query)
    {
        $entities = $this->retrieveEntitiesWithBacktrackId();
        $resArr = [];

        foreach($entities as $entity) {
            if($entity[$unique_key] == $query) {
                $resArr[] = $entity;
            }
        }

        foreach($resArr as $item) {
            DocumentEntity::whereId($item["entity_id"])->update([
               "schema_id" => -1
            ]);
        }

        return [
            "success" => true
        ];
    }

    public function retrieveEntitiesWithBacktrackId()
    {
        // Retrieve all DocumentEntities via schema id.
        $entities = DocumentEntity::whereSchemaId($this->schema->id)->get();
        $flattenedEntities = [];

        foreach ($entities as $entity) {
            $attributes = [];

            $documentEntityPoints = DocumentEntityPoint::whereEntityId($entity->id)->get();
            foreach ($documentEntityPoints as $point) {
                $attributes[] = ["point_id" => $point->id];
                $attributes[] = [$point->name => $point->value];
            }
            $attributes[] = ["entity_id" => $entity->id];
            $flattenedEntities[] = array_collapse($attributes);
        }

        return $flattenedEntities;
    }

    /**
     * Retrieve entities by schema
     *
     * @return array
     */
    public function retrieveEntities()
    {
        // Retrieve all DocumentEntities via schema id.
        $entities = DocumentEntity::whereSchemaId($this->schema->id)->get();
        $flattenedEntities = [];

        foreach ($entities as $entity) {
            $attributes = [];

            $documentEntityPoints = DocumentEntityPoint::whereEntityId($entity->id)->get();
            foreach ($documentEntityPoints as $point) {
                $attributes[] = [$point->name => $point->value];
            }

            $flattenedEntities[] = array_collapse($attributes);
        }

        return $flattenedEntities;
    }

}
