@extends('site.layouts.basico')
@section('titulo', 'Produtos')

@section('conteudo')
    @include('site.layouts._pages.pesquisaProduto')
    @include('sweetalert::alert')
@endsection
