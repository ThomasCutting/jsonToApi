<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointVaulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_vaules', function (Blueprint $table) {
            $table->increments('id');

            $this->generatePointValuePoints($table);

            $table->timestamps();
        });
    }

    protected function generatePointValuePoints(Blueprint &$table) {
        $table->integer("point_id")->default(0);
        $table->string("string_value")->default("");
        $table->integer("integer_value")->default(0);
        $table->float("float_value")->default(0.00);
        $table->boolean("boolean_value")->default(false);
        $table->dateTime("datetime_value")->default(\Carbon\Carbon::now());
        $table->string("json_value")->default("");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_vaules');
    }
}
