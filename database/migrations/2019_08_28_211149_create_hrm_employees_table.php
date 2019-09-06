<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrmEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 50);
            $table->unique('number');
            $table->string('username', 100);
            $table->unique('username');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('surname', 50);
            $table->date('date_of_birth');
            $table->string('gender', 1);
            $table->text('address')->nullable();
            $table->string('mobile_number', 20);
            $table->string('alternate_number', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('grade_id')->unsigned()->nullable();
            $table->foreign('grade_id')->references('id')->on('hrm_grades');
            $table->integer('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('hrm_branches');
            $table->integer('job_function_id')->unsigned()->nullable();
            $table->foreign('job_function_id')->references('id')->on('hrm_job_functions');
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('hrm_employees');
            $table->string('status', 50);
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
        Schema::dropIfExists('hrm_employees');
    }
}
