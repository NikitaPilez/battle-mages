<?php

namespace App\Models\V1\Infection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_eternal',
        'mark',
        'repeat'
    ];
}
