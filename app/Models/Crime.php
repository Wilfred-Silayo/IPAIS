<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category', 'location', 'date_occurred', 'is_resolved'
    ];
}
