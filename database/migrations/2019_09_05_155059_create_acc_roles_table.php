<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->unique('title');
            $table->integer('link_id')->unsigned();
            $table->foreign('link_id')->references('id')->on('acc_links');
            $table->boolean('all')->default(false);
            $table->text('departments');
            $table->text('units');
            $table->text('job_functions');
            $table->text('employees');
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
        Schema::dropIfExists('acc_roles');
    }
}
