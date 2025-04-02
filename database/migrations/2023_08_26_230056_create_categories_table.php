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
        Schema::create('categories', function (Blueprint $table) {
            // $table->bigInteger('id')->unsigned()->autoIncrement()->primary(); =====same====> $table->id();
            $table->id();
            $table->string('name',255);   
            $table->string('slug')->unique();
            $table->unsignedBigInteger('parent_id')->nullable();  //unsigned + BigInteger + null
            $table->timestamps();
            //created_at (timestamp) -> date time   +  updated_at (timestamp)   =====same====> $table->timestamps();
            // $table->foreign('parent_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
