@extends('layouts.app')

@section('title', 'Detalle del municipio')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
    </div>
@endsection
