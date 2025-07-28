@extends('site.layouts.basico')
@section('titulo', 'Login')

@section('conteudo')
    @include('site.layouts._auth.email')
    @include('sweetalert::alert')
@endsection
