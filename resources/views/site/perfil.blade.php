@extends('site.layouts.basico')
@section('titulo', 'Pefil')

@php

    if (isset($activeTab)) {
        var_dump($activeTab);
    }
@endphp

@section('conteudo')
    @include('site.layouts._components.perfil', ['activeTab'])
    @include('sweetalert::alert')
@endsection
