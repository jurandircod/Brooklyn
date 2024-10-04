@extends('site.layouts.basico')
@section('titulo', 'Pefil')

@section('conteudo')
    @include('site.layouts._components.perfil')
    @include('sweetalert::alert')
@endsection
