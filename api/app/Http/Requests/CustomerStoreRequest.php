<?php

namespace App\Http\Requests;

use App\Models\Customers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CustomerStoreRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phonenumber' => 'required|string|max:20',
            'billingaddress' => 'required|string|max:255', // Ensure this matches
            'isactive' => 'required|boolean',
        ];
    }
}
