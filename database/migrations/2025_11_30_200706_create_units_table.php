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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('correlative');
            $table->foreignId('unit_type_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('number');
            $table->tinyInteger('floor');
            $table->string('rol')->unique();
            $table->decimal('surface');
            $table->decimal('proration', 10, 7);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
