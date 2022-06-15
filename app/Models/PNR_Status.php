<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PNR_Status extends Model
{
    use HasFactory;
    protected $table = 'pnr_status';

    protected $fillable = ['user_id',
                          'pnr_number',
                          'train_name',
                          'train_number',
                          'source_station',
                          'boarding_station',
                          'destination_station',
                          'reservation_station',
                          'quota',
                          'ticket_fare',
                          'chart_status',
                          'journey_class',
                          'number_of_passengers',
                          'booking_date',
                          'date_of_journey'
                         ];
}
