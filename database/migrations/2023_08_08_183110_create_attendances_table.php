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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->boolean('absent')->default(false);
            $table->boolean('on_leave')->default(false);
            $table->text('notes')->nullable();
            $table->integer('rating')->nullable();
            $table->date('entry_date')->nullable();
            // $table->unsignedBigInteger('employee_id');
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('users')->references('id')->onDelete('cascade');
            $table->string('creator_name')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};