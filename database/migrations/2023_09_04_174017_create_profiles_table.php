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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users','id')->cascadeOnDelete(); //one to many  ==> unique (هاي خلت العلاقه one to one ==>one user one profile)
            $table->string('first_name'); 
            $table->string('last_name');
            $table->string('country')->nullable();
            $table->enum('gender',['male','female']);
            $table->date('birthday')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
