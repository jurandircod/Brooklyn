@extends('administrativo.layouts.basico')
@section('titulo', 'Produto')

@section('conteudo')
    @include('administrativo.layouts._forms.produtos.cadProduto')
    @include('administrativo.layouts._components.produtos.listProdutos')
    @include('sweetalert::alert')
@endsection
