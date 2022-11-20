<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eqcatagory extends Model
{
    use HasFactory,SoftDeletes;
    
        public function stor()
        {
            return $this->hasMany(Stor::class);
        }
}   
