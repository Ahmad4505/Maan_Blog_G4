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
        Schema::create('roles_abilities', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles','id')->nullOnDelete();
            $table->foreignId('ability_id')->constrained('abilities','id')->nullOnDelete();
            $table->primary(['role_id','ability_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_abilities');
    }
};
