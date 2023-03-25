@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h3 class="card-title">Agregar empleado</h3>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary float-right">Volver</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('empleados.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="numero_empleado">Numero de empleado</label>
                                <input type="text" name="numero_empleado" id="numero_empleado" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="id_puesto">Puesto</label>
                                <select name="id_puesto" id="id_puesto" class="form-control">
                                    @foreach($puestos as $puesto)
                                        <option value="{{ $puesto->id }}">{{ $puesto->puesto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
