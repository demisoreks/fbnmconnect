<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHrmEmployeesTable01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrm_employees', function (Blueprint $table) {
            $table->string('mobile_number', 20)->nullable()->change();
            $table->renameColumn('email', 'alternate_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrm_employees', function (Blueprint $table) {
            //
        });
    }
}
