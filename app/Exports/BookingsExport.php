<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{

    public function headings(): array {
        return ['ID', 'Cliente', 'Email', 'Fecha de Reserva', 'Número de Personas'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::with(['tour', 'hotel'])
            ->get()
            ->map(function($booking){
                return [
                    $booking->id,
                    $booking->customer_name,
                    $booking->customer_email,
                    $booking->booking_date,
                    $booking->number_of_people,
                ];
            });
    }
}
