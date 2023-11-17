<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortContracts extends Model
{
    use HasFactory,SoftDeletes;
  // Name Table
  protected $table = 'short_contracts';
    // Permaitions Data Gets
    protected $guarded = [];
}
