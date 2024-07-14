<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=['content','post_id','user_id','is_most_wanted'];

    public function crime(){
        return $this->belongsTo(Crime::class);
    }

    public function lostItem(){
        return $this->belongsTo(LostItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','username');
    }
}
