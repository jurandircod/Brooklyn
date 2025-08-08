@extends('site.layouts.basico')
@section('titulo', 'Contatos')

@section('conteudo')
    @include('site.layouts._partials.breadcrumb')
    @yield('breadcrumb')
    @include('site.layouts._pages.contato')
    @include('sweetalert::alert')
@endsection
