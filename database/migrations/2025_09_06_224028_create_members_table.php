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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('name');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('address')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'khonghucu'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};