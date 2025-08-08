
@extends('site.layouts.basico')
@section('titulo', 'Login')

@section('conteudo')
    @include('site.layouts._auth.login')
    
    @include('sweetalert::alert')
@endsection
