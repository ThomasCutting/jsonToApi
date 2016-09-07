<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_types', function (Blueprint $table) {
            $table->increments('id');

            $this->generatePointTypePoints($table);

            $table->timestamps();
        });
    }

    protected function generatePointTypePoints(Blueprint &$table) {
        $table->string("type_name"); // e.g. Boolean/Integer/String/DateTime/Float
        $table->integer("default_value_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_types');
    }
}
