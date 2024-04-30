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
        if (!Schema::hasTable('project_creator')) {
            Schema::create('project_creator', function (Blueprint $table) {
                $table->bigInteger('project_id')->unsigned();
                $table->bigInteger('creator_id')->unsigned();

                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
                $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForign(['project_id']);
        $table->dropColumn('project_id');
        $table->dropForign(['creator_id']);
        $table->dropColumn('creator_id');
    }
};
