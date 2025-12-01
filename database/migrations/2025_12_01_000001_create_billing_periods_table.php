<?php

use App\Models\BillingPeriod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billing_periods', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->string('status')->default('draft');
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        BillingPeriod::create([
            'month' => 11,
            'year' => now()->year,
            'status' => 'open',
            'opened_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('billing_periods');
    }
};
