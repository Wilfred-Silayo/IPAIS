<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path','crime_id','lost_item_id'];
    
    public function lostItem()
    {
        return $this->belongsTo(LostItem::class);
    }

    public function crime()
    {
        return $this->belongsTo(Crime::class);
    }
}
