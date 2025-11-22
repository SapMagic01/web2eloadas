<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ertek extends Model
{
    protected $table = 'ertek'; // ha a táblaneved nem "erteks"

    public $timestamps = false;

    protected $fillable = [
        'forint',
    ];

    public function allatok()
    {
        return $this->hasMany(Allat::class, 'ertekid', 'id');
    }
}
