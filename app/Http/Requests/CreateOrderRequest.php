<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'id_user' => 'required|exists:users,id',
            'id_store' => 'required|exists:stores,id',
            'instructions' => 'nullable|string',
            'delivery_date' => 'required|date',
            'address' => 'required|string',
            'rate' => 'required|integer|min:1|max:5',
        ];
    }
}
