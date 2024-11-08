@extends('administrativo.layouts.basico')
@section('titulo', 'Produto')

@section('conteudo')
@include('administrativo.layouts._forms.produtos.cadProduto')
    @include('sweetalert::alert')
@endsection