@extends('site.layouts.basico')
@section('titulo', 'Usuários')

@section('conteudo')
@include('site.layouts._partials.breadcrumb')
@yield('breadcrumb')
    @include('site.layouts._pages.perfil')
    @include('sweetalert::alert')
@endsection
