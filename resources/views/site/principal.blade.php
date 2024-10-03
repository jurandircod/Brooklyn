@extends('site.layouts.basico')
@section('titulo', 'Principal')


@section('conteudo')
        @include('site.layouts._components.carousel')
        @include('site.layouts._components.banner')
        @include('site.layouts._components.produtos')
@endsection

