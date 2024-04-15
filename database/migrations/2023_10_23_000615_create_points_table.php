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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("plan_id")->nullable();
            $table->integer("credit")->nullable();
            $table->integer("debit")->nullable();
            $table->integer("amount");
            $table->integer("available_general_point")->nullable();
            $table->integer("available_integral_point")->nullable();
            $table->integer("post_id")->nullable();
            $table->integer("episode_id")->nullable();
            $table->tinyInteger("type");
            $table->integer("creator_id")->nullable();
            $table->integer("status")->nullable();
            $table->integer("payment_id")->nullable();
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
        Schema::dropIfExists('points');
    }
};
