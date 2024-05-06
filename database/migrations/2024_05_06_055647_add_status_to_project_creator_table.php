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
            $table->tinyInteger('status')->nullable()->after('bid')->comment('0 =>,cancel, 1 => confirm, 2 => bid');
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
            $table->dropColumn('status');
        });
    }
};
