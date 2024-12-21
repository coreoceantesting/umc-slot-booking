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
    Schema::table('slot', function (Blueprint $table) {
        $table->string('fromtime')->nullable(); 
        $table->string('totime')->nullable();   
    });
}

public function down(): void
{
    Schema::table('slot', function (Blueprint $table) {
        $table->dropColumn('fromtime');
        $table->dropColumn('totime');
    });
}

};
