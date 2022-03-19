<?php

namespace App\Http\Resources;

use App\Models\Evaluation;
use Carbon\Carbon;
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
           'Date' => Carbon::make($this->created_at)->format('Y-m-d'),
           'Company' => new TenantResource($this->tenant),
           'Client' => $this->client_id ? new ClientResource($this->client) : '',
           'Table' => $this->table_id ? new TableResource($this->table) : '',
           'Products' => ProductResource::collection($this->products),
           'Evaluations' => EvaluationResource::collection($this->evaluations),
        ];
    }
}
