<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpoilageDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'spoilage_id' => $this->spoilage_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'expiry_date' => $this->expiry_date,
            'cost_per_quantity' => $this->cost_per_quantity,
            'created_at' => $this->created_at,
        ];
    }
}
