<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable=['sender_id','receiver_id','is_seen',
    'deleted_by_sender','deleted_by_receiver','content'
    ];
}