<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourUpdateRequest extends FormRequest
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
            'price' => 'sometimes|numeric',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array {
        return [
            'name.string' => 'El nombre del tour debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            
            'description.string' => 'La decripción debe ser una cadena de caracteres.',

            'price.numeric' => 'El precio debe ser un número.',

            'start_date.date' => 'Ingrese una fecha de inicio válida.',

            'end_date.date' => 'Ingrese una fecha de finalizaciión válida.',
            'end_date.after_or_equal' => 'La fecha de finalización no puede ser anterior a la fecha de inicio.'
        ];
    }
}
