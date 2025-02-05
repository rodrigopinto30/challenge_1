<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'address' => 'sometimes|string',
            'rating' => 'sometimes|integer',
            'price_per_night' => 'sometimes|numeric',
        ];
    }

    public function messages(): array {
        return [
            'name.string' => 'El nombre del hotel debe comenzar con una letra.',
            'name.max' => 'El nombre del hotel no puede superar los 255 caracteres.',

            'description.string' => 'La descripción debe comenzar con una letra.',

            'address.string' => 'La dirección debe comenzar con una letra.',

            'rating.integer' => 'El rating debe ser un número entero.',
            
            'price_per_night.numeric' => 'El precio por noche debe ser un número válido.'
        ];
    }
}
