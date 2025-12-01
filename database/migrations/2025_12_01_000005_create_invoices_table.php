<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_period_id')->constrained('billing_periods')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('subtotal_common', 12, 2)->default(0);
            $table->decimal('reserve_percent', 10, 7)->default(0);
            $table->decimal('reserve_amount', 12, 2)->default(0);
            $table->decimal('mora_percent', 10, 7)->default(0);
            $table->decimal('mora_amount', 12, 2)->default(0);
            $table->decimal('total_to_pay', 12, 2)->default(0);
            $table->string('status')->default('draft');
            $table->string('number')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
