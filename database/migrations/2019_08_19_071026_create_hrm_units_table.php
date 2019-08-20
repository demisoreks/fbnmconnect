<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrmUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->unique('name');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('hrm_departments');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_units');
    }
}
