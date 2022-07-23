<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LotsResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'category' => $this->category,
            'num' => $this->num,
            'low_estimate' => $this->low_estimate,
            'high_estimate' => $this->high_estimate,
            'starting_price' => $this->starting_price,
            'created' => $this->created_at->format('d.m.Y H:i'),
            'edit' =>  route('admin.lots.edit', $this->id),
            'destroy' => route('admin.lots.destroy', $this->id),
            'consigner' => $this->consigner
        ];
    }
}
