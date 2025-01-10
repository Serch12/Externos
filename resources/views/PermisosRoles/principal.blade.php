@extends('layouts.app')

@section('content') 
<permisosroles-component id_usuario_logeado = "{{ auth()->user()->id }}" name_usuario_logeado = "{{ auth()->user()->name }}" rol_usuario = "{{ $rol_usuario }}" componente="Home"></permisosroles-component>
@endsection