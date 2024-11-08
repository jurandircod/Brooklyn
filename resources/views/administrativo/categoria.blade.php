@extends('administrativo.layouts.basico')
@section('titulo', 'Categoria')

@section('conteudo')
@include('administrativo.layouts._forms.produtos.cadCategoria')
@include('administrativo.layouts._components.produtos.listCategoria')
    @include('sweetalert::alert')
@endsection