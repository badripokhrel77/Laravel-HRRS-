<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'room';
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'room_status',
    ];

    public function category(){
        return $this->belongsTo(RoomCategory::class, 'category_id');
    }
}
