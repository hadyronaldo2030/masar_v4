<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectProgramming extends Model
{
    use HasFactory,SoftDeletes;
    // Name Table
    protected $table = 'project_programmings';

    // Permaitions Data Gets
    protected $guarded = [];
}
