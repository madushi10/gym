<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stor extends Model
{
    use HasFactory, SoftDeletes;
    public function eqcatagories()
    {
        return $this->belongsTo(Eqcatagory::class);
    }
}
