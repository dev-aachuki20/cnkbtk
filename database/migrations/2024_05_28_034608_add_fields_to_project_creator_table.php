<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_creator', function (Blueprint $table) {
            $table->integer('assign_status')->after('creator_status')->nullable()->default(0)->comment('0=> unassigned, 1 => assigned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_creator', function (Blueprint $table) {
            $table->dropColumn('assign_status');
        });
    }
};
