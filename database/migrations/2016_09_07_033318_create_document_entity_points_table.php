<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentEntityPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_entity_points', function (Blueprint $table) {
            $table->increments('id');

            $this->generateDocumentEntityPointPoints($table);

            $table->timestamps();
        });
    }

    protected function generateDocumentEntityPointPoints(Blueprint &$table) {
        $table->string("name")->default("");
        $table->integer("entity_id");
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
        Schema::dropIfExists('document_entity_points');
    }
}
