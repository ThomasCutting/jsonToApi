<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentSchemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_schemas', function (Blueprint $table) {
            $table->increments('id');

            $this->generateDocumentSchemaPoints($table);

            $table->timestamps();
        });
    }

    protected function generateDocumentSchemaPoints(Blueprint &$table) {
        $table->string("name");
        $table->string("token")->default("");
        $table->integer("owner_id")->default(0);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_schemas');
    }
}
