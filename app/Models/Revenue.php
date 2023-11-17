<?php

namespace App\Models;
use App\Models\RevenueImages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
    use HasFactory,SoftDeletes;

    // Name Table
    protected $table = 'revenues';

    // Permaitions Data Gets
    protected $guarded = [];

    
 
}
