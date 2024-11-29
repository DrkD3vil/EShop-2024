<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('username')->unique()->default('guest')->after('email');
            $table->string('phone')->nullable()->default('Not Provided')->after('username');
            $table->text('address')->nullable()->default('Not Available')->after('phone');
            $table->string('image')->nullable()->default('default.png')->after('address');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
