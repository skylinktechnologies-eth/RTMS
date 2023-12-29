<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waitstaff_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waitstaff_id')->constrained();
            $table->foreignId('table_id')->constrained();
            $table->date('assignment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitstaff_assignments');
    }
};
