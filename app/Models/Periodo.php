<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = ['periodo'];

    public function calculo()
    {
        return $this->hasMany(Calculo::class,'periodo_id');
    }

    public function movimiento()
    {
        return $this->hasMany(Movimiento::class,'periodo_id');
    }
}
