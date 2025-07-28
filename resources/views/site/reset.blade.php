@extends('site.layouts.basico')
@section('titulo', 'Login')

@section('conteudo')
    @include('site.layouts._auth.reset')
    @include('sweetalert::alert')
@endsection
