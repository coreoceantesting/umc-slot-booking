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
        Schema::create('aadharcards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();  
            $table->enum('citizen_type', ['General', 'Senior Citizen']); 
            $table->string('image_path')->nullable(); 
            $table->boolean('is_required')->default(true); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aadharcards');
    }
};
