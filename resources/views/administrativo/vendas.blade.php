@extends('administrativo.layouts.basico')
@section('titulo', 'Home')

@section('conteudo')
    @include('administrativo.layouts._pages.vendas')
    @include('sweetalert::alert')
@endsection
