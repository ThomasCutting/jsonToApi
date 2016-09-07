<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SampleDocumentSchemaSeeder::class);
    }
}

/**
 * Class SampleDocumentSchemaSeeder
 */
class SampleDocumentSchemaSeeder extends Seeder
{
    /**
     * @return mixed
     */
    public function run()
    {
        // Create and return a new document schema.
        $documentSchema = \App\DocumentSchema::create([
            "name" => "BlogPost",
            "token" => sha1("BlogPost") // TODO: SHA1 is okay for token-generation.
        ]);

        $schemaArray = [
            [
                "type" => "integer",
                "name" => "id"
            ],
            [
                "type" => "string",
                "name" => "title"
            ],
            [
                "type" => "string",
                "name" => "body"
            ]
        ];

        foreach ($schemaArray as $item) {
            $pointType = $this->generatePointType($item["type"]);
            $documentSchemaPoint = new \App\DocumentSchemaPoint();
            $documentSchemaPoint->name = $item["name"];
            $documentSchemaPoint->schema_id = $documentSchema->id;
            $documentSchemaPoint->type_id = $pointType->id;
            $documentSchemaPoint->value_id = 0;
            $documentSchemaPoint->save();
        }

        $entityArray = [
            [
                [
                    "type" => "string",
                    "name" => "title",
                    "value" => "Hello, World!"
                ],
                [
                    "type" => "integer",
                    "name" => "id",
                    "value" => 2
                ],
                [
                    "type" => "string",
                    "name" => "body",
                    "value" => "Lorem ipsum sit amet, sit amough."
                ]
            ]
        ];

        foreach ($entityArray as $entity) {

            // Build a document entity.
            $documentEntity = new \App\DocumentEntity();
            $documentEntity->schema_id = $documentSchema->id;
            $documentEntity->save();

            foreach($entity as $item) {
                $documentEntityPoint = new \App\DocumentEntityPoint();
                $documentEntityPoint->id = rand(rand(0,50),50000);
                $tempPair = $this->generatePointValuePair($item["type"], $item["value"],$documentEntityPoint->id);
                $documentEntityPoint->name = $item["name"];
                $documentEntityPoint->entity_id = $documentEntity->id;
                $documentEntityPoint->type_id = $tempPair["type"]->id;
                $documentEntityPoint->value_id = $tempPair["value"]->id;
                $documentEntityPoint->save();
            }
        }
    }

    private function generatePointType($type)
    {
        $pointType = new \App\PointType();
        switch ($type) {
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