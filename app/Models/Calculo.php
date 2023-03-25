<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{
    use HasFactory;

    protected $fillable = ['empleado_id', 'periodo_id', 'sueldo_base', 'bono_x_entrega', 'bono_x_hora', 'vales_despensa', 'isr', 'total'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'empleado_id');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }
}
