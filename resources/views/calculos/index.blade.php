@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Listado de nomina</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">{{ __('Volver a empleados') }}</a>
                    </div>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Empleado') }}</th>
                                <th>{{ __('Periodo') }}</th>                                
                                <th>{{ __('Sueldo Base') }}</th>
                                <th>{{ __('Bono x Entrega') }}</th>
                                <th>{{ __('Bono x Hora') }}</th>
                                <th>{{ __('Vales Despensa') }}</th>
                                <th>{{ __('ISR') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calculos as $calculo)
                                <tr>
                                    <td>{{ $calculo->empleado->nombre }}</td>
                                    <td>{{ $calculo->periodo->periodo }}</td>
                                    <td>{{ $calculo->sueldo_base }}</td>
                                    <td>{{ $calculo->bono_x_entrega }}</td>
                                    <td>{{ $calculo->bono_x_hora }}</td>
                                    <td>{{ $calculo->vales_despensa }}</td>
                                    <td>{{ $calculo->isr }}</td>
                                    <td>{{ $calculo->total }}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $calculos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
