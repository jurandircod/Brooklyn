@extends('site.layouts.basico')
@section('titulo', 'Produtos')

@section('conteudo')
    @include('site.layouts._pages.pesquisaProduto')
    @include('site.layouts._partials.breadcrumb')
    @yield('breadcrumb')
    @include('sweetalert::alert')
@endsection
