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
        Schema::create('membership_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('concept')->default('Cuota');
            $table->integer('year');
            $table->unsignedSmallInteger('period')->default(1);
            $table->unsignedInteger('amount')->default(0);
            $table->unsignedInteger('paid_amount')->default(0);
            $table->date('due_at');
            $table->datetime('paid_at')->nullable();
            $table->foreignId('income_type_id')->constrained('income_types')->restrictOnDelete();
            $table->enum('status', ['pendiente', 'parcial', 'pagado', 'vencido'])->default('pendiente');
            $table->timestamps();
            $table->softDeletes();

            // Índice para búsquedas frecuentes
            $table->index(['user_id', 'year', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_fees');
    }
};
