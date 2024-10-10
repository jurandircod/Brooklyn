@extends('site.layouts.basico')
@section('titulo', 'Principal')


@section('conteudo')
        @include('site.layouts._components.principal.carousel')
        @include('site.layouts._components.principal.banner')
        @include('site.layouts._components.principal.produtos')
@endsection

