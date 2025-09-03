@extends('site.layouts.basico')
@section('titulo', 'Fazer Pedido')

@section('conteudo')
    @include('site.layouts._partials.breadcrumb')
    @yield('breadcrumb')
    @include('site.layouts._pages.fazerPedido')
    @include('sweetalert::alert')
@endsection
