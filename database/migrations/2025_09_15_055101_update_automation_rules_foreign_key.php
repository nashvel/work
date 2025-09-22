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
        Schema::table('t_projects_automation_rules', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->foreign('project_id')->references('id')->on('t_project_management')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_projects_automation_rules', function (Blueprint $table) {
            // Drop the corrected foreign key
            $table->dropForeign(['project_id']);
            
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }
};
