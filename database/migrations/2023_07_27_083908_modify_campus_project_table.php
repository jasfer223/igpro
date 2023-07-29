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
        Schema::table('campus_project', function (Blueprint $table) {
            $table->foreignId('campus_id')
                ->contrained('campuses')
                ->onDelete('cascade');
            $table->foreignId('project_id')
                ->contrained('projects')
                ->onDelete('cascade'); 
            $table->foreignId('status_id')
                ->contrained('statuses')
                ->onDelete('cascade'); 
        });                 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
