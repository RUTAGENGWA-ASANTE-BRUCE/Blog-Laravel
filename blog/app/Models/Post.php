<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'body',
        'user_id'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
}
