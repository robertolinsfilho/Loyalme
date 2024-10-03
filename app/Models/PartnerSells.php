<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerSells extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'amount',
        'comission_amount',
        'payload',
        'status',
        'date',
    ];
}
