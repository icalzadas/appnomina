<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['numero_empleado', 'nombre', 'id_puesto'];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class,'id_puesto');
    }

    public function calculo()
    {
        return $this->hasMany(Calculo::class, 'empleado_id');
    }

    public function movimiento()
    {
        return $this->hasMany(Movimiento::class, 'empleado_id');
    }
}
