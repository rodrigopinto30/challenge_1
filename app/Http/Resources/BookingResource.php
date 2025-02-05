<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'number_of_people' => $this->number_of_people,
            // 'tour' => new,
            // 'hotel' => new,
            'tour_name' => $this->tour->name,
            'hotel_name' => $this->hotel->name,
            'booking_data' => $this->booking_data,
        ];
    }
}
