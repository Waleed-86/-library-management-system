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
    Schema::create('books', function (Blueprint $table) {
        $table->id();                              // Auto ID number
        $table->string('title');                   // Book title
        $table->string('author');                  // Author name
        $table->string('isbn')->unique();          // Unique book code
        $table->string('genre');                   // Genre (Fiction etc)
        $table->integer('total_copies');           // Total copies in library
        $table->integer('available_copies');       // Available to borrow
        $table->string('cover_image')->nullable(); // Book cover image
        $table->timestamps();                      // created_at, updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
