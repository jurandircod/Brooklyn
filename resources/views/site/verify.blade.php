@extends('site.layouts.basico')
@section('titulo', 'Login')

@section('conteudo')
    @include('site.layouts._auth.verify-email')
    @include('sweetalert::alert')
@endsection
