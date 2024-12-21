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
        Schema::table('users', function (Blueprint $table) {
            $table->string('fullname')->nullable()->after('remember_token'); 
            $table->string('age')->nullable()->after('fullname'); 
            $table->string('dob')->nullable()->after('age'); 
            $table->string('username')->nullable()->after('dob'); 
            $table->string('citizenType')->nullable();
            $table->string('image')->nullable();
            $table->string('departmentid')->nullable();  
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fullname', 'age', 'dob', 'username','citizenType', 'image','departmentid']);
        });
    }
};
