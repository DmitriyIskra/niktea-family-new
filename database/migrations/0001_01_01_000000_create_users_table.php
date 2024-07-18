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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('user_active')->default(true);
            $table->string('name'); 
            $table->string('second_name');
            $table->string('patronymic');
            $table->integer('balls')->default(0);
            $table->boolean('lottery')->default(false);  // 0 - не участник розыгрыша, 1 - участник розыгрыша
            
            
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('index')->nullable();
            $table->string('area')->nullable();
            $table->string('district')->nullable();
            $table->string('settlement');
            $table->string('street');
            $table->string('house');
            $table->string('appartment')->nullable();

            $table->json('gifts_for_points')->nullable();
            $table->json('gift_for_lottery')->nullable();
            $table->boolean('awarded')->default(false);
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->boolean('admin')->default(false);
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
