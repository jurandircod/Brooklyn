@extends('administrativo.layouts.basico')
@section('titulo', 'Permissões')

@section('conteudo')
    @include('administrativo.layouts._forms.permissoes.cadFormPermissao')
    @include('administrativo.layouts._components.permissoes.listPermissoes')
    @include('sweetalert::alert')
@endsection
