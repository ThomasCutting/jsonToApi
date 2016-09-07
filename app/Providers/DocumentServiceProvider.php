<?php

namespace App\Providers;

use App\DocumentEntity;
use App\DocumentEntityPoint;
use App\DocumentSchema;

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

    /**
     * Retrieve entities by schema
     *
     * @return array
     */
    public function retrieveEntities()
    {
        // Retrieve all DocumentEntities via schema id.
        $entities = DocumentEntity::whereId($this->schema->id)->get();
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
