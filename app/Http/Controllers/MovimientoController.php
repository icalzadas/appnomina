<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Movimiento;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        $movimientos = $empleado->movimiento()->with('periodo')->paginate(5);
        return view('movimientos.index', compact('movimientos', 'empleado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        $periodos = Periodo::all();
        //var_dump($empleado);
        return view('movimientos.create', compact('empleado', 'periodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empleado $empleado)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'periodo_id' => 'required|exists:periodos,id',
            'cantidad_entregas' => 'required|numeric|min:1'
        ]);
    
        $movimiento = new Movimiento([
            'empleado_id' => $request->input('empleado_id'),  
            'periodo_id' => $request->input('periodo_id'),
            'cantidad_entregas' => $request->input('cantidad_entregas')
        ]);
    
        $empleado->movimiento()->save($movimiento);
    
        return redirect()->route('empleados.index')
            ->with('success', 'Movimiento agregado correctamente.');
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
    public function destroy(Empleado $empleado, Movimiento $movimiento)
    {
        // Verifico si el movimiento pertenece al empleado
        if ($empleado->id === $movimiento->empleado_id) {
            $movimiento->delete();
            return redirect()->route('empleados.movimientos.index', $empleado)->with('success', 'Movimiento eliminado correctamente');
        } else {
            return redirect()->route('empleados.movimientos.index', $empleado)->with('error', 'No se puede eliminar el movimiento');
        }
    }

}
