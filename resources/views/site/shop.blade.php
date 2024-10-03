@extends('site.layouts.basico')
@section('titulo', 'Produtos')

@section('conteudo')
    @include('site.layouts._components.shop')
    @include('sweetalert::alert')
@endsection
