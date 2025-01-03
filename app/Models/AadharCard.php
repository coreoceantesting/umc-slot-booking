<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AadharCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ="aadharcards";

    protected $fillable = [
        'name',
        'citizen_type',
        'image_path',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];
}
