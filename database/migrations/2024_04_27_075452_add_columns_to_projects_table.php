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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Pictures', 'Video', 'Novel', 'Tutorial'])->nullable();
            $table->unsignedBigInteger('tags_id')->nullable();
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');

            $table->text('comment')->nullable();
            $table->string('creator_id')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->boolean('copyright')->default(0);
            $table->tinyInteger("status")->default(0)->nullable();
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
        Schema::dropIfExists('projects');
    }
};
