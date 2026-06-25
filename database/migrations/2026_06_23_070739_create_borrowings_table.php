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
    Schema::create('borrowings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Which student
        $table->foreignId('book_id')->constrained()->onDelete('cascade');  // Which book
        $table->foreignId('book_request_id')->constrained()->onDelete('cascade'); // Which request
        $table->date('borrowed_date');   // When borrowed
        $table->date('due_date');        // Must return by this date
        $table->date('returned_date')->nullable(); // When actually returned
        $table->integer('fine')->default(0);       // Fine amount in Rs
        $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
