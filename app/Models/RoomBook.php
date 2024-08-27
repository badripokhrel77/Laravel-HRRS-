<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBook extends Model
{
    use HasFactory;
    // Define the table associated with the model
    protected $table = 'roombook';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',
        'phone',
        'checkin',
        'checkout',
        'roomtype',
        'roomno',
        'guestn',
        'message'
    ];

    // If you have any date fields, specify them here
    protected $dates = [
        'checkin',
        'checkout',
    ];

    // Example of a relationship (if applicable)
    // public function room()
    // {
    //     return $this->belongsTo(Room::class);
    // }
}
