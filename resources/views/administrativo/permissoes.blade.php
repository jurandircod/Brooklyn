@extends('administrativo.layouts.basico')
@section('titulo', 'Teste')

@section('conteudo')
    @include('administrativo.layouts._forms.cadFormPermissao')
    @include('sweetalert::alert')
@endsection