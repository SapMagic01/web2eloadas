<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allat extends Model
{
    protected $table = 'allat'; // ha nem "allats"

    public $timestamps = false;

    protected $fillable = [
        'nev',
        'ertekid',
        'ev',
        'katid',
    ];

    public function ertek()
    {
        return $this->belongsTo(Ertek::class, 'ertekid', 'id');
    }

    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class, 'katid', 'id');
    }
}
