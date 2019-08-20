<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrmJobFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_job_functions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->unique('name');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('hrm_units');
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
        Schema::dropIfExists('hrm_job_functions');
    }
}
