@extends('administrativo.layouts.basico')
@section('titulo', 'Marca')

@section('conteudo')
@include('administrativo.layouts._forms.marcas.cadMarca')
@include('administrativo.layouts._components.marcas.listMarcas')
    @include('sweetalert::alert')
@endsection