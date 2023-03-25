<?php

namespace App\Http\Controllers;

use App\Models\Calculo;
use App\Models\Empleado;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Models\Periodo;

class CalculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calculos = Calculo::with('empleado','periodo')->orderBy('periodo_id', 'desc')->paginate(50);
        return view('calculos.index', compact('calculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = Periodo::all();
        return view('calculos.create', compact('periodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'periodo_id' => 'required|exists:periodos,id',
        ]);

        $periodo_id = $request->input('periodo_id');

        //si ya existe el calculo para el periodo seleccionado, entonces lo borro para poder recalcular.
        if (Calculo::where('periodo_id', $periodo_id)->exists()) {
            Calculo::where('periodo_id', $periodo_id)->delete();
        }

        //Obtengo todos los empleados y sus respectivos puestos
        $empleados = Empleado::with('puesto')->get();

        //obtengo los movimientos del periodo
        $movimientos = Movimiento::where('periodo_id', $periodo_id)->get();

        foreach($empleados as $emp){

            $movimientos_empleado = $movimientos->where('empleado_id', $emp->id)->first();

            if ($movimientos_empleado !== null) {
                $entregas = $movimientos_empleado->cantidad_entregas;
            }else{
                $entregas = 0;
            }

            if ($emp->puesto->cantidad_bono_x_hora !== null){
                $cantidad_bono_x_hora = $emp->puesto->cantidad_bono_x_hora;
            }else{
                $cantidad_bono_x_hora = 0;
            }

            $sueldo_base = ((30 * 8) * 6) * 4; //calculo fijo mensual
            $bono_x_entregas = 5 * $entregas; //calculo del bono por las entregas del periodo
            $bono_x_hora = (($cantidad_bono_x_hora * 8) * 6) * 4; //calculo de bono por hora trabajada
            $vales_despensa = $sueldo_base * 0.04;

            $total_percepciones = $sueldo_base + $bono_x_entregas + $bono_x_hora;

            if ($total_percepciones > 10000){
                $isr = $total_percepciones * 0.12;
            }else{
                $isr = $total_percepciones * 0.09;
            }

            $total = ($total_percepciones + $vales_despensa) - $isr;

            // Crear un nuevo calculo
            $calculo = new Calculo();
            $calculo->empleado_id = $emp->id;
            $calculo->periodo_id = $request->periodo_id;
            $calculo->sueldo_base = $sueldo_base;
            $calculo->bono_x_entrega = $bono_x_entregas;
            $calculo->bono_x_hora = $bono_x_hora;
            $calculo->vales_despensa = $vales_despensa;
            $calculo->isr = $isr;
            $calculo->total = $total;
            $calculo->save();
        } 
        return redirect()->route('calculos.create')->with('success', 'Calculo generado correctamente.');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
