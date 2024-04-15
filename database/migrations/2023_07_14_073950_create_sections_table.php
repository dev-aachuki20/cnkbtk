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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string("name_en");
            $table->string("name_ch");
            $table->integer("parent_id")->nullable();
            $table->string("description_en",1000)->nullable();
            $table->string("description_ch",1000)->nullable();
            $table->string("section_logo")->nullable();
            $table->enum("creator_can_post",["0","1"])->nullable();
            $table->tinyInteger("level");
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
        Schema::dropIfExists('sections');
    }
};
