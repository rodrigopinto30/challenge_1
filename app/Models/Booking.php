<?php

namespace App\Models;

use BookingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'hotel_id',
        'customer_name',
        'customer_email',
        'number_of_people',
        'booking_date',
    ];

    protected $cast = [
        'status' => BookingStatus::class,
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function search(Builder $query, string $termino = null): Builder{

        if($termino){
            $query->whereHas('tour', function ($q2) use ($termino){
                $q2->where('name', 'like', "%{$termino}%");
            })
            ->orWhereHas('hotel', function ($q2) use ($termino){
                $q2->where('name', 'like', "%{$termino}%");
            })
            ->orWhere('customer_name', 'like', "%{$termino}%");
        }

        return $query;
    }

    public function dateRange(Builder $query, ?string $from=null, ?string $to=null): Builder{

        if($from){
            $query->where('bookiong_date', '>=', $from);
        }

        if($to){
            $query->where('booking_date', '<=', $to);
        }

        return $query;
    }
}
