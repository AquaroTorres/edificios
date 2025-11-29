<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('minute_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('minute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('attended')->default(false);
            $table->timestamps();
            $table->unique(['minute_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('minute_user');
    }
};
