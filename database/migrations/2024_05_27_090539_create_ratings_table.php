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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('project_id')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->tinyInteger('creator_id')->nullable();
            $table->tinyInteger('user_rating')->nullable();
            $table->tinyInteger('creator_rating')->nullable();
            $table->text('user_remark')->nullable();
            $table->text('creator_remark')->nullable();
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
        Schema::dropIfExists('ratings');
    }
};
