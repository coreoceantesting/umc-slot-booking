<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SlotBooking extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'slotbookings';

    protected $fillable = [
        'propertytype',
        'propertytypename',
        'address',
        'fullname',
        'mobileno',
        'bookingpurpose',
        'citizentype',
        'slot',
        'booking_date',
        'sdamount',
        'scamount',
        'registrationno',
        // 'files',
        'filesaadhar',
        'filesresidency',
        'filesevents',
        'activestatus',
        'status'
    ];
}
