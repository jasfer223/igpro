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
        Schema::table('accomplishment_reports', function (Blueprint $table) {
            $table->foreignId('campus_project_id')
                    ->contrained('campus_project')
                    ->onDelete('cascade');            
            $table->foreignId('success_indicator_id')
                    ->contrained('success_indicators')
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
