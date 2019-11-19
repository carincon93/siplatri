@extends('layouts.app')

@section('title', '!Oops! Esta acción no esta permitida')

@section('content')
    <div class="d-flex align-items-center justify-content-center flex-column">
        <h2 class="text-center">Esta acción no esta autorizada para tu rol</h2>

        <a href="{{ route('proyectos.index') }}" class="btn btn-danger flex-1">Regresar al panel inicial</a>
        {{-- <h2>{{ $exception->getMessage() }}</h2> --}}
    </div>
@endsection
