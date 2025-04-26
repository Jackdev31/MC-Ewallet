<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cashier_sales', function (Blueprint $table) {
            // This will ensure the user_id is correctly added and nullable
            $table->foreignId('user_id')->nullable()->constrained('users')->after('id');
        });
    }


    public function down()
    {
        Schema::table('cashier_sales', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
