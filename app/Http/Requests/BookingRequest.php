<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'tour_id' => 'required|exists:tours,id',
            'hotel_id' => 'required|exists:hotels,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'number_of_people' => 'required|integer|min:1',
            'booking_date' => 'required|date',
        ];
    }

    public function messages(): array {
        return [
            'tour_id.required' => 'Por favor, seleccione un tour.',
            'tour_id.exists' => 'El tour seleccionado no existe.',

            'hotel_id.required' => 'Por favor, seleccione un hotel.',
            'hotel_id.exists' => 'El hotel seleccionado no existe.',

            'customer_name.required' => 'El nombre del cliente es obligatorio.',
            'customer_name.string' => 'El nombre debe comenzar con una letra. Por ejemplo: Pedro.',
            'customer_name.max' => 'El nombre no puede superar los 255 caracteres.',

            'customer_email.required' => 'El correo electrónico es obligatorio.',
            'customer_email.email' => 'Ingrese un correo electrónico válido, por ejemplo: juanperez@gmail.com',
            'customer_email.max' => 'El correo electrónico no puede superar los 255 caracteres.',
            
            'number_of_people.required' => 'Por favor, indicar cuantas personas asistirán.',
            'number_of_people.integer' => 'La cantidad de personas debe ser un número.',
            'number_of_people.min' => 'Debe haber al menos una persona en la reserva.',
            
            'booking_date.required' => 'Por favor, selecciona una fecha para la reserva.',
            'booking_date.date' => 'Por favor, ingrese una fecha válida.' 
        ];
    }
}
