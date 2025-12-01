<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('run')->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('join_date')->nullable();
            $table->string('position')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_super_admin')->default(false);
            $table->enum('membership_status', ['activo', 'inactivo', 'suspendido'])->default('activo');

            $table->text('signature')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Crear un usuario administrador
        User::create([
            'name' => 'Administrador',
            'company' => 'N/A',
            'run' => '12345678-9',
            'email' => 'demo@floxtor.app',
            'phone' => '+1234567890',
            'join_date' => now(),
            'is_active' => true,
            'is_admin' => true,
            'is_super_admin' => true,
            'membership_status' => 'activo',
            'password' => bcrypt('floxtor'),
            'password_changed_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
