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
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string("title_en")->nullable();
            $table->string("title_ch")->nullable();
            $table->integer("parent_section")->nullable();
            $table->integer("sub_section")->nullable();
            $table->integer("child_section")->nullable();
            $table->string("tag_type")->nullable();
            $table->text("tags")->nullable();
            $table->longtext("description_en")->nullable();
            $table->longtext("description_ch")->nullable();
            $table->tinyinteger("status")->default(0);
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
        Schema::dropIfExists('posters');
    }
};
