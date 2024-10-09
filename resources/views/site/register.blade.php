@extends('site.layouts.basico')
@section('titulo', 'Pefil')

@section('conteudo')
    @include('site.layouts._auth.register')
    @include('sweetalert::alert')
@endsection