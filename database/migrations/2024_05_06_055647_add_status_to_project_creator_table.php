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
            $table->tinyInteger('creator_status')->nullable()->after('bid')->comment('0 =>,cancel, 1 => confirm, 2 => bid');
            $table->tinyInteger('user_status')->nullable()->after('bid')->comment('0 =>,cancel, 1 => confirm');
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
            $table->dropColumn('creator_status');
            $table->dropColumn('user_status');
        });
    }
};
