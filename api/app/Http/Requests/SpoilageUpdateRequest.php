<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpoilageUpdateRequest extends FormRequest
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
            'branch_no' => 'required',
            'damaged_date' => 'required',
            'remarks' => 'required',
            'prepared_by_id' => 'required',
            'approved_by_id',
            'is_cancelled',
            'cancelled_by',
        ];
    }
}
