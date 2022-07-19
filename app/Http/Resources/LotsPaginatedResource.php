<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LotsPaginatedResource extends JsonResource
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
            'items' => LotsResource::collection($this),
            'next' => $this->nextPageUrl() ?? '',
            'previous' => $this->previousPageUrl() ?? '',
            'last' => $this->lastPage(),
            'current' => $this->currentPage(),
        ];
    }
}
