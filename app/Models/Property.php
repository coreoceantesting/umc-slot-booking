<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{
    use HasFactory, SoftDeletes;

     protected $table = "property";
 
     protected $fillable = ['propertytypename','name', 'address'];
 
     public static function booted()
     {
         static::created(function (self $user)
         {
             if (Auth::check()) {
                 self::where('id', $user->id)->update([
                     'created_by' => Auth::user()->id,
                 ]);
             }
         });
 
         static::updated(function (self $user)
         {
             if (Auth::check()) {
                 self::where('id', $user->id)->update([
                     'updated_by' => Auth::user()->id,
                 ]);
             }
         });
 
         static::deleting(function (self $user)
         {
             if (Auth::check()) {
                 self::where('id', $user->id)->update([
                     'deleted_by' => Auth::user()->id,
                 ]);
             }
         });
     }
}
