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
        Schema::create('blacklist_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_ch')->nullable();
            $table->string('status')->default(0)->comment('1=>active, 0 =>inactive');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blacklist_tags');
    }
};
