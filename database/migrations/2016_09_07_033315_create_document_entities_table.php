<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_entities', function (Blueprint $table) {
            $table->increments('id');

            $this->generateDocumentEntityPoints($table);

            $table->timestamps();
        });
    }

    protected function generateDocumentEntityPoints(Blueprint &$table) {
        $table->integer("schema_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_entities');
    }
}
