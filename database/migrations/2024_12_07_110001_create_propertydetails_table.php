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
        Schema::create('propertydetails', function (Blueprint $table) {
            $table->id();
            $table->string('propertytypename');
            $table->string('propertyname');
            $table->string('slot');
            $table->decimal('gamount', 10, 2); 
            $table->decimal('sdamount', 10, 2);
            $table->decimal('citizenamount', 10, 2); 
            $table->decimal('citizensdamount', 10, 2); 
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertydetails');
    }
};
