<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any invalid religion values to NULL
        DB::table('members')->whereNotIn('religion', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'khonghucu'])->update(['religion' => null]);
        
        // Then modify the column to ensure proper enum values
        Schema::table('members', function (Blueprint $table) {
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'khonghucu'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('religion')->nullable()->change();
        });
    }
};