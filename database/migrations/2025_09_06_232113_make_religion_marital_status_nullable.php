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
        Schema::table('members', function (Blueprint $table) {
            // Make religion nullable
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'khonghucu'])->nullable()->change();
            
            // Make marital_status nullable
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Revert religion to not nullable
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'khonghucu'])->nullable(false)->change();
            
            // Revert marital_status to not nullable
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable(false)->change();
        });
    }
};