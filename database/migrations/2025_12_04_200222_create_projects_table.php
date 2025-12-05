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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('category');
        $table->string('image_path')->nullable(); // Stores the path to the uploaded image

        // New Required Fields:
        $table->string('technology_used')->nullable(); 
        $table->string('live_view_url')->nullable(); 
        $table->string('github_link')->nullable(); 
        
        $table->string('status')->default('Draft');
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
