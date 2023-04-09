<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    public function genres(){
        return $this->belongsToMany(Genre::class,'content_genre');
    }

    public function movielinks()
    {
        return $this->hasMany(MovieLink::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
