@extends('site.layouts.basico')
@section('titulo', 'Sobre')

@section('conteudo')
    @include('site.layouts._partials.breadcrumb')
    @yield('breadcrumb')
    @include('site.layouts._pages.sobre')
@endsection
