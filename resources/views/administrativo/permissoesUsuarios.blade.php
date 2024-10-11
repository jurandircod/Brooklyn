@extends('administrativo.layouts.basico')
@section('titulo', 'Usuario')

@section('conteudo')
@include('administrativo.layouts._components.permissoes.listUsuarios')
    @include('sweetalert::alert')
@endsection
