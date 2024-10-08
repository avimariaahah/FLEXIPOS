<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesInvoiceResource extends JsonResource
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
            'branch_id' => $this->branch_id,
            'sales_order_id' => $this->sales_order_id,
            'customer_id' => $this->customer_id,
            'processed_by_id' => $this->processed_by_id,
            'cancel_type' => $this->cancel_type,
            'cancel_id' => $this->cancel_id,
            'approve_type' => $this->approve_type,
            'approve_id' => $this->approve_id,
            'document_no' => $this->document_no,
            'date' => $this->date,
            'is_approved' => $this->is_approved,
            'is_cancelled' => $this->is_cancelled,
            'created_at' => $this->created_at,
        ];
    }
}
