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
        Schema::create('projects_marketing', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('department', ['graphics', 'Marketing', 'Administrative', 'photography', 'video', 'sales']);
            $table->string('project_manager')->nullable();
            $table->string('tmLeader');
            $table->json('team');
            $table->text('notesmar')->nullable();
            $table->string('file_marketing')->nullable();
            $table->string('creator_name')->nullable();
            $table->enum('completion_percentage', ['0%', '10%', '80%', '100%'])->default('0%');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
