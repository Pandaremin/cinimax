<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Content extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ['title','cover','poster','release_date','rating','duration','overview','view','trailer','publish','featured','premium_only','content_type','user_id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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
