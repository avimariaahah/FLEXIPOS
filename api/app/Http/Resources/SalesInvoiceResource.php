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
            'prepared_by_id' => $this->prepared_by_id,
            'cancelled_by_id' => $this->cancelled_by_id,
            'approved_by_id' => $this->approved_by_id,
            'invoice_no' => $this->invoice_no,
            'sales_invoice_ref_doc_no' => $this->sales_invoice_ref_doc_no,
            'date' => $this->date,
            'due_date' => $this->due_date,
            'terms' => $this->terms,
            'is_cancelled' => $this->is_cancelled,
            'is_approved' => $this->is_approved,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at,
        ];
    }
}
