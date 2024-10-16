<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'user_id'
    ];
    public function images(){
        return $this->hasMany(Images::class,'news_id');
    }
    public function article(){
        return $this->hasOne(article::class);
    }
}
