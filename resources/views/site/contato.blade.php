@extends('site.layouts.basico')
@section('titulo', 'Contato')

@section('conteudo')
    @include('site.layouts._pages.contato')
    @include('sweetalert::alert')
@endsection
