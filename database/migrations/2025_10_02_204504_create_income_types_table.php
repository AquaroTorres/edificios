<?php

use App\Models\IncomeType;
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
        Schema::create('income_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->foreignId('account_id')->default(1)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('budget')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        IncomeType::create([
            'name' => 'Inscripciones',
            'description' => 'Primera inscripción del socio',
            'account_id' => 1,
            'is_active' => true,
        ]);

        IncomeType::create([
            'name' => 'Membresias',
            'description' => 'Pagos de membresía anuales o periódicos',
            'account_id' => 1,
            'is_active' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_types');
    }
};
