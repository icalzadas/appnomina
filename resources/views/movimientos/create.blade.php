@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agregar movimiento para: {{ $empleado->nombre }}, Puesto: {{$empleado->puesto->puesto}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('empleados.movimientos.store',$empleado) }}">
                            @csrf

                            <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">

                            <div class="form-group row">
                                <label for="periodo_id" class="col-md-4 col-form-label text-md-right">{{ __('Periodo') }}</label>

                                <div class="col-md-6">
                                    <select id="periodo_id" class="form-control @error('periodo_id') is-invalid @enderror" name="periodo_id" required>
                                        <option value="">Seleccione un periodo</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                                        @endforeach
                                    </select>

                                    @error('periodo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cantidad_entregas" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad de entregas') }}</label>

                                <div class="col-md-6">
                                    <input id="cantidad_entregas" type="number" class="form-control @error('cantidad_entregas') is-invalid @enderror" name="cantidad_entregas" value="{{ old('cantidad_entregas') }}" required>

                                    @error('cantidad_entregas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Agregar movimiento') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
