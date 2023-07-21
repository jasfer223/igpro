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
        Schema::create('campus_project', function (Blueprint $table) {
            $table->id();
            $table -> foreignId('project_id') -> constrained('projects') -> onDelete('cascade');
            $table -> foreignId('campus_id') -> constrained('campuses') -> onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campus_project');
    }
};
