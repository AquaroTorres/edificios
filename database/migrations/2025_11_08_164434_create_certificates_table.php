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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->date('issued_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('certificate_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('signer_id_1')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('signer_id_2')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('signer_id_3')->constrained('users')->onDelete('cascade');
            $table->dateTime('citation_start')->nullable();
            $table->dateTime('citation_end')->nullable();
            $table->string('institution')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
