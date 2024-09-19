<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Specify the table if it does not follow Laravel's naming convention
    protected $table = 'transactions';

    // Specify the fields that are mass assignable
    protected $fillable = ['pidx','payment_method','payment_status','amount', 'user_id', 'other_fields']; 

    // Add any other model configurations here
    public function roomBook()
{
    return $this->belongsTo(RoomBook::class, 'roombook_id'); // Adjust the foreign key if necessary
}

}
