<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizechart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'label',
        'weight',
        'width',
        'height',
        'breath'
    ];
}
