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
        Schema::table('unique_visitors', function (Blueprint $table) {
            $table->tinyInteger('device_name')->nullable()->after('ip_address')->comment('0 for mobile, 1 for desktop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unique_visitors', function (Blueprint $table) {
            $table->dropColumn('device_name');
        });
    }
};
