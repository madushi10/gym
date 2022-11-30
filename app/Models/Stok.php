<?php

namespace App\Models;

use App\Models\Stok;
use App\Models\Eqcatagory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stok extends Model
{
    use HasFactory,SoftDeletes;
    public function eqcatagories()
    {
        return $this->belongsTo(Eqcatagory::class);
    }
}
