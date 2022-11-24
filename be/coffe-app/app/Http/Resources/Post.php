<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'desc'=>$this->desc,
            'body'=>$this->body,
            'thumbnail'=>$this->thumbnail ? 'http://127.0.0.1:8082/img/'.$this->thumbnail : 'http://127.0.0.1:8082/img/empty.jpg',
            'status'=>$this->status,
            'created_by'=>$this->getCreatedBy->name,
        ];
    }
}
