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
        Schema::create('t_projects_automation_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('type'); 
            $table->string('trigger'); 
            $table->string('action'); 
            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');
            $table->json('conditions')->nullable(); 
            $table->json('parameters')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_executed')->nullable();
            $table->integer('execution_count')->default(0);
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('t_project_management')->onDelete('cascade');
            $table->index(['project_id', 'is_active']);
            $table->index(['type', 'trigger']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automation_rules');
    }
};
