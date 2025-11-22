<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
{
    protected $table = 'kategoria'; // ha nem "kategorias"

    public $timestamps = false;

    protected $fillable = [
        'nev',
    ];

    public function allatok()
    {
        return $this->hasMany(Allat::class, 'katid', 'id');
    }
}
