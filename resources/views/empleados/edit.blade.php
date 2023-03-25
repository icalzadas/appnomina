@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Editar empleado</h3>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary float-right">Volver</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="numero_empleado">Numero de empleado:</label>
                                <input type="text" class="form-control" id="numero_empleado" name="numero_empleado" value="{{ old('numero_empleado', $empleado->numero_empleado) }}">
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}">
                            </div>

                            <div class="form-group">
                                <label for="puesto">Puesto:</label>
                                <select class="form-control" id="id_puesto" name="id_puesto">
                                    @foreach($puestos as $puesto)
                                        <option value="{{ $puesto->id }}" {{ $empleado->id_puesto == $puesto->id ? 'selected' : '' }}>{{ $puesto->puesto }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
