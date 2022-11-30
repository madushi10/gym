<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fine extends Model
{
    use HasFactory,SoftDeletes;
     public function users()
     {
        return $this->belongsTo(User::class);
     }

     public function booking()
     {
        return $this->belongTo(Booking::class);
     }
     protected $fillable = [
        'user_id',
        'booking_id',
        'status',
        'amount',
    ];
}
