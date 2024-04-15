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
        Schema::create('user_episodes', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("poster_id");
            $table->integer("episode_id");
            $table->string("points");
            $table->text("episode_title");
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
        Schema::dropIfExists('user_episodes');
    }
};
