<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'rating' => 'required|integer',
            'price_per_night' => 'required|numeric',
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Por favor, ingrese el nombre de un hotel.',
            'name.string' => 'El nombre del hotel debe comenzar con una letra.',
            'name.max' => 'El nombre del hotel no puede superar los 255 caracteres.',
            
            'description.required' => 'La descripción del hotel es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            
            'address.required' => 'Por favor, ingrese una dirección.',
            'address.string' => 'La dirección debe comenzar con una letra.',

            'rating.required' => 'El rating del hotel es obligatorio.',
            'rating.integer' => 'El rating debe ser un número',

            'price_per_night.required' => 'El precio por noche es obligatorio.',
            'price_per_night.numeric' => 'El precio por noche debe ser un número válido.'
        ];
    }
}
