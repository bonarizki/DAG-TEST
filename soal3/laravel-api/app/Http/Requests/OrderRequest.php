<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
        if ($this->method() === 'GET') {
            return [
                'customer_name' => 'sometimes|string',
            ];
        }elseif ($this->method() === 'POST') {
            return [
                'customer_name' => 'required|string',
                'menu_item' => 'required|string',
                'quantity' => 'required|integer|min:1',
            ];
        }
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'product.required'       => 'Produk pesanan harus ada.',
            'quantity.required'      => 'Jumlah pesanan harus diisi.',
            'quantity.numeric'       => 'Jumlah pesanan harus berupa angka.',
            'quantity.min'           => 'Jumlah minimal harus lebih dari 0.',
        ];
    }

    /**
     * failedValidation
     *
     * @param  mixed $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $message = collect($validator->errors()->all());

        throw new HttpResponseException(
            response()->json(['message' => $message], 422)
        );
    }
}
