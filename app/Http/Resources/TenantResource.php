<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            'Nome' => $this->name,
            'CNPJ' => $this->cnpj,
            'image' => $this->logo ? url("/Storage/{$this->logo}") : '',
            'Uuid' => $this->uuid,
            'URL' => $this->url,
            'Contato' => $this->email,
        ];
    }
}
