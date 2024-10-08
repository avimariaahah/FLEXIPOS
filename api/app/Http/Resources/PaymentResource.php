<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_method_id' => $this->payment_method_id,
            'bill_id' => $this->bill_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
