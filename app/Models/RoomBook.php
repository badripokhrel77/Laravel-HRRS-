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
        'message',
        'status'
    ];

    // If you have any date fields, specify them here
    protected $dates = [
        'checkin',
        'checkout',
    ];

    // Example of a relationship (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
