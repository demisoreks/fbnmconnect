<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHrmEmployeesTable05 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrm_employees', function (Blueprint $table) {
            $table->datetime('last_login')->nullable()->after('employment_date');
            $table->string('last_login_ip', 100)->nullable()->after('last_login');
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
