<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
           'Identify' => $this->identify, 
           'Total' => $this->total,
           'Status' => $this->status,
           'Client' => $this->client_id ? new ClientResource($this->client) : '',
           'Table' => $this->table_id ? new TableResource($this->table) : '',
           'Products' => ProductResource::collection($this->products),
        ];
    }
}
