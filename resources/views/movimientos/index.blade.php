@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Movimientos de empleado '.$empleado->nombre) }}</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">{{ __('Volver a empleados') }}</a>
                        <a href="{{ route('empleados.movimientos.create', ['empleado' => $empleado->id]) }}" class="btn btn-primary">{{ __('Agregar movimiento') }}</a>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Periodo') }}</th>
                                <th>{{ __('Cantidad entregas') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movimientos as $movimiento)
                                <tr>
                                    <td>{{ $movimiento->id }}</td>
                                    <td>{{ $movimiento->periodo->periodo }}</td>
                                    <td>{{ $movimiento->cantidad_entregas }}</td>
                                    <td>
                                        
                                        <form action="{{ route('empleados.movimientos.destroy', [$empleado, $movimiento]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar este movimiento?') }}')">{{ __('Eliminar') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $movimientos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
