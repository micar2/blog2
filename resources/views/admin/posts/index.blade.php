@extends('admin.layouts.layout')

@section('header')
    <h1>
        Todas las Publicaciones
        <small>Listado completo de Posts</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
    </ol>
@endsection

@section('content')
    <h3>Listado de Posts</h3>
@endsection