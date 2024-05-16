<?php

namespace App\Http\Requests\BetterPay;

use Illuminate\Foundation\Http\FormRequest;

class StandardPaymentRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1.5',
            'payment_desc' => 'required|max:1000',
            // 'invoice' => 'required|unique:payments|max:17',
            'invoice' => 'required|max:17',
        ];
    }
}
