@extends('layouts.app')

@section('content') 
<jugadores-component id_usuario_logeado = "{{ auth()->user()->id }}" name_usuario_logeado = "{{ auth()->user()->name }}" rol_usuario = "{{ $rol_usuario }}" sede = "{{ $sede }}" permisos="{{json_encode($permisos)}}" componente="Jugadores"></jugadores-component >
@endsection
