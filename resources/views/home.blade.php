@extends('layouts.app')

@section('content') 
<home-component id_usuario_logeado = "{{ auth()->user()->id }}" name_usuario_logeado = "{{ auth()->user()->name }}" rol_usuario = "{{ $rol_usuario }}"sede = "{{ $sede }}" componente="Home"></home-component>
@endsection