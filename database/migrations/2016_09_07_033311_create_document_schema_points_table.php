<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentSchemaPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_schema_points', function (Blueprint $table) {
            $table->increments('id');

            $this->generateDocumentSchemaPointPoints($table);

            $table->timestamps();
        });
    }

    protected function generateDocumentSchemaPointPoints(Blueprint &$table) {
        $table->integer("schema_id");
        $table->string("name");
        $table->integer("type_id");
        $table->integer("value_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_schema_points');
    }
}
