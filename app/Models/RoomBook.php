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
        'room_status'
    ];

    // Specify date fields if applicable
    protected $dates = [
        'checkin',
        'checkout',
    ];

    // Relationships

    // RoomBook belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RoomBook belongs to a Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    // RoomBook has one Transaction
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'roombook_id', 'id');
    }
}