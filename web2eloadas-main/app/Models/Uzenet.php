<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzenet extends Model
{
    use HasFactory;

    // Engedélyezzük ezeknek a mezőknek a kitöltését
    protected $fillable = [
        'nev',
        'email',
        'szoveg',
    ];
}
