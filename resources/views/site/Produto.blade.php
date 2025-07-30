@extends('site.layouts.basico')
@section('titulo', 'Produtos')


@section('conteudo')
    @include('site.layouts._pages.Produto')
    @include('sweetalert::alert')
@endsection
