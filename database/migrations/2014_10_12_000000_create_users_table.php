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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
<<<<<<< HEAD
            $table->string('phone_number');
            $table->string('profile_photo');
            $table->string('certificate');
            $table->rememberToken();
            $table->timestamp('remember_token_expiration')->nullable();
            $table->timestamps();

=======
            $table->string('phone_number')->unique();
            $table->string('profile_photo')->unique();
            $table->string('certificate')->unique();
            $table->rememberToken();
            $table->string('verification_code')->unique()->nullable();
            $table->timestamp('verification_code_expiration')->nullable();
            $table->timestamps();
>>>>>>> 2caf74e (task_3)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
