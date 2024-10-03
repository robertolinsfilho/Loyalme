<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerSellsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'external_id' =>$this->external_id,
            'amount' => $this->amount,
            'comission_amount' => $this->comission_amount,
            'payload' => $this->payload,
            'status' => $this->status,
            'date' => $this->date,
        ];
    }
}
