<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('slotbookings', function (Blueprint $table) {
            $table->id(); 
            $table->string('propertytype')->nullable();
            $table->string('propertytypename')->nullable();
            $table->string('address')->nullable();
            $table->string('fullname')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('bookingpurpose')->nullable();
            $table->date('booking_date')->nullable();
            $table->string('citizentype')->nullable();
            $table->string('slot')->nullable();
            $table->string('sdamount')->nullable(); 
            $table->string('scamount')->nullable();
            $table->string('registrationno')->nullable();
            $table->string('files')->nullable(); 
            $table->enum('activestatus', ['pending', 'approve', 'reject','return'])->default('pending');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slotbookings');
    }
};
