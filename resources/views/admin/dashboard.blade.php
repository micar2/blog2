@extends('admin.layouts.layout')

@section('content')
    <h1>Dashboard</h1>
    <p>Usuario autenticado: {{ auth()->user()->name }}</p>
    <p>Correo electrónico: {{ auth()->user()->email }}</p>
@endsection