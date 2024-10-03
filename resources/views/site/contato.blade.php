@extends('site.layouts.basico')
@section('titulo', 'Contato')

@section('conteudo')
    @include('site.layouts._components.contato')
    @include('sweetalert::alert')
@endsection
