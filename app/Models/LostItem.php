<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category', 'location','reported_by','is_published', 'date_reported', 'is_found'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'reported_by','username');
    }
}
