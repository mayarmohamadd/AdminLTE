<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'category_id'=>$this->category_id,
            'news_id'=>$this->news_id,
            'created_at'=>$this->created_at,
            'Category'=>new CategoryResource($this->category),
        ];
    }
}
