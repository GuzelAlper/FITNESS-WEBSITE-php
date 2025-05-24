<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration')->nullable(); // dakika cinsinden
            $table->integer('sets')->nullable();
            $table->integer('reps')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete(); // eğitmen
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();   // kullanıcı
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workouts');
    }
};
