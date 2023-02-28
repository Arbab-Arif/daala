<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    const HEADER = 'Header';
    const FOOTER = 'Footer';

    protected $fillable = [
        'title',
        'parent_id',
        'slug',
        'type',
        'content'
    ];

    public function childPages()
    {
        return $this->hasMany(static::class, 'parent_id')->where('type', static::FOOTER);
    }
}
