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
        Schema::create('dataapprove', function (Blueprint $table) {
            $table->id();
            $table->integer('applicationid')->nullable();
            
            $table->integer('warduserid')->nullable();
            $table->timestamp('wardapprovaldate')->nullable();
            $table->string('wardremark')->nullable();
            $table->enum('wardstatus', ['approve', 'pending'])->default('pending')->nullable();

            $table->integer('officeruserid')->nullable();
            $table->timestamp('officerapprovaldate')->nullable();
            $table->string('officerremark')->nullable();
            $table->enum('officerstatus', ['approve', 'pending','approved'])->default('pending')->nullable();

            $table->integer('clerkuserid')->nullable();
            $table->timestamp('clerkapprovaldate')->nullable();
            $table->string('clerkremark')->nullable();
            $table->enum('clerkstatus', ['approve', 'pending'])->default('pending')->nullable();

            $table->integer('hoduserid')->nullable();
            $table->timestamp('hodapprovaldate')->nullable();
            $table->string('hodremark')->nullable();
            $table->enum('hodstatus', ['approve', 'pending'])->default('pending')->nullable();

            $table->integer('assuserid')->nullable();
            $table->timestamp('assapprovaldate')->nullable();
            $table->string('assremark')->nullable();
            $table->enum('assstatus', ['approve', 'pending'])->default('pending')->nullable();

            $table->integer('adduserid')->nullable();
            $table->timestamp('addapprovaldate')->nullable();
            $table->string('addremark')->nullable();
            $table->enum('addstatus', ['approve', 'pending'])->default('pending')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataapprove');
    }
};
