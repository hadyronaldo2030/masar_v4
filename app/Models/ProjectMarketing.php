<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMarketing extends Model
{
    use HasFactory,SoftDeletes;
       // Name Table
       protected $table = 'projects_marketing';

       // Permaitions Data Gets
       protected $guarded = [];


    //    public function team()
    //    {
    //        return $this->belongsTo(User::class, 'team_id');
    //    }
}
