<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    // to connect with english database
    protected $connection = 'english';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function news(){
        return $this->hasOne(news::class);
    }
    // public function images(){
    //     return $this->hasMany(Images::class,'news_id','news_id');
    // }

}
