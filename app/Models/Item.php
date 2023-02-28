<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name','unit','description','category_id'];

    public function sizeChart()
    {
        return $this->hasMany(Sizechart::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
