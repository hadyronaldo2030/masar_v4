<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Revenue;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevenueImages extends Model
{
    use HasFactory,SoftDeletes;
    // Selected Name Table
    protected $table = 'revenue_images';

    // Selected Data To pass in Table
    protected $guarded = [];
    // protected $fillable = ['image1','image2','image3','image4','image5','image6','image7','image8','image9','image10', 'revenues_id', 'id'];


    // Relaitions To Revenues
    public function Revenue()
    {
        return $this->belongsTo(Revenue::class);
    }

}
