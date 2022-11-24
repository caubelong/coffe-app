<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'name'=>$this->name,
            'cate_id'=>$this->cate_id,
            'cate_name'=>$this->getCategory->name,
            'desc'=>$this->desc,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'status'=>$this->status,
            'thumbnail'=> $this->thumbnail ? 'http://127.0.0.1:8082/img/'.$this->thumbnail : 'http://127.0.0.1:8082/img/empty.jpg',
            'created_by'=>$this->getCreatedBy->name,
        ];
    }
}
