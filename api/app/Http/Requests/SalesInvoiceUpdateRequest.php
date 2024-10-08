<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesInvoiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branch_id' => 'required',
            'sales_order_id' => 'required',
            'customer_id' => 'required',
            'processed_by_id' => 'required',
            'cancel_type' => 'required',
            'cancel_id' => 'required',
            'approve_type' => 'required',
            'approve_id' => 'required',
            'document_no' => 'required',
            'date' => 'required',
            'is_approved' => 'required',
            'is_cancelled' => 'required',
        ];
    }
}
