@extends('layouts.app')

@section('title', '!Oops! Página no encontrada')

@section('content')
    <section class="d-flex justify-content-center align-items-center mt-5">
        <div class="container">
            <h2 class="text-center display-4 mb-0">SIPLATRI</h2>
            <h2 class="text-center display-1 mt-0">404</h2>
            <p class="text-center">
                La página que estás buscando no existe o ha ocurrido un error. <br>
                Por favor retrocede o dirígete a la <a href="{{ url('/') }}" class="btn-link text-light">página principal</a>
            </p>
        </div>
    </section>
@endsection
