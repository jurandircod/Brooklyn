@extends('site.layouts.basico')
@section('titulo', 'Produtos')



@section('conteudo')
    @include('site.layouts._pages.produtos.descricao')
    @include('site.layouts._partials.breadcrumb')
    @yield('breadcrumb')
    @include('site.layouts._pages.produtos.produtosRelacionados')
    @include('site.layouts._pages.Produto')
    @include('sweetalert::alert')
@endsection
