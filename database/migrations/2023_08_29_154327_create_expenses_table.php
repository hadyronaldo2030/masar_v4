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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2); 
            $table->enum('invoice_type', ['Gas', 'Electricity', 'Water', 'Subscriptions', 'Others']); 
            $table->date('start_date');
            $table->date('due_date');
            $table->text('notes')->nullable(); 
            $table->string('image');
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
        Schema::dropIfExists('expenses');

    }
};
