@extends('site.layouts.basico')
@section('titulo', 'Carrinho')


@section('conteudo')
    @include('site.layouts._partials.breadcrumb')
    @yield('breadcrumb')
    @include('site.layouts._pages.cart')
    @include('sweetalert::alert')
@endsection
