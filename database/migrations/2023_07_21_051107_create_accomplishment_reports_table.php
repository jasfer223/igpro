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
        Schema::create('accomplishment_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campus_project_id')->constrained('campus_project')->onDelete('cascade');
            $table->foreignId('success_indicator_id')->constrained('success_indicators')->onDelete('cascade');
            $table->string('target');
            $table->integer('quantity');
            $table->string('quantity_remarks');
            $table->string('percentage');
            $table->string('percentage_remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomplishment_reports');
    }
};
