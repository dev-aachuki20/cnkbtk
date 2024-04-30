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
            $table->enum('type', ['Pictures', 'Video', 'Novel', 'Tutorial']);
            $table->text('tags')->nullable();
            $table->text('comment')->nullable();
            $table->string('creator_id');
            $table->decimal('budget', 10, 2); 
            $table->boolean('copyright')->default(0);
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
        Schema::dropIfExists('projects');
    }
};
