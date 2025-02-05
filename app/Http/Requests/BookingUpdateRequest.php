<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
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
            'tour_id' => 'sometimes|exists:tours,id',
            'hotel_id' => 'sometimes|exists:hotels,id',
            'customer_name' => 'sometimes|string|max:255',
            'customer_email' => 'sometimes|email|max:255',
            'number_of_people' => 'sometimes|integer|min:1',
            'booking_date' => 'sometimes|date',
        ];
    }

    public function messages(): array {
        return [
            'tour_id.exists' => 'El tour seleccionado no existe.',

            'hotel_id.exists' => 'El hotel seleccionado no existe.',

            'customer_name.string' => 'El nombre debe contener solo letras.',
            'customer_name.max' => 'El nombre no puede superar los 255 caracteres.',

            'customer_email.email' => 'Por favor, ingresar un correo electrónico válido.',
            'customer_email.max' => 'El correo electrónico no puede superar los 255 caracteres',

            'number_of_people.integer' => 'La cantidad de personas debe ser un número.',
            'number_of_people.min' => 'Debe haber al menos una persona en la reserva.',
            
            'booking_date.date' => 'Ingresar una fecha válida.',
        ];
    }
}
