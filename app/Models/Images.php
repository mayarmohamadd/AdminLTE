<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{


    protected $fillable = ['file_path', 'news_id'];

    public function article(){
        return $this->belongsTo(news::class);
    }
}

