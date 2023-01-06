<?php

namespace App\Models;

use App\Enums\TableLocation;
use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'tel_number', 'res_date', 'guest_number', 'table_id'];
    use HasFactory;


    protected $dates = [
        'res_date'=>'datetime'
    ];

    public function tables(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
