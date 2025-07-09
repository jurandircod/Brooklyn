@extends('site.layouts.basico')
@section('titulo', 'Registrar')

@section('conteudo')
    @include('site.layouts._auth.register')
    @include('sweetalert::alert')
@endsection