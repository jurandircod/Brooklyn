@extends('administrativo.layouts.basico')
@section('titulo', 'Home')

@section('conteudo')
    @include('administrativo.layouts._pages.principal')
    @include('sweetalert::alert')
@endsection
