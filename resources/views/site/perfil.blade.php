@extends('site.layouts.basico')
@section('titulo', 'Pefil')

@section('conteudo')
    @include('site.layouts._pages.perfil')
    @include('sweetalert::alert')
@endsection
