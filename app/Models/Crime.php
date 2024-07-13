<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category', 'location', 'reported_by','is_published','date_occurred', 'is_resolved','is_most_wanted'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'reported_by','username');
    }
}
