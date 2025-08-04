@extends('administrativo.layouts.basico')
@section('titulo', 'suporte')

@section('conteudo')
    @include('administrativo.layouts._pages.suporte.suporte')
    @include('sweetalert::alert')
@endsection