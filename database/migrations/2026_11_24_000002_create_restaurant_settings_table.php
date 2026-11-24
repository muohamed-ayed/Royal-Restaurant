<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurant_settings', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->boolean('admin_created')->default(false);
            $table->timestamps();
        });

        DB::table('restaurant_settings')->insert([
            'id' => 1,
            'admin_created' => DB::table('users')->where('role', 'admin')->exists(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_settings');
    }
};
