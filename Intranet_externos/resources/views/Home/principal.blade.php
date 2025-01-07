{{-- @extends('layouts.app')

@section('content') 
<home-component id_usuario_logeado = "{{ auth()->user()->id }}" name_usuario_logeado = "{{ auth()->user()->name }}" cambio_contrasena = "{{$password}}" rol_usuario = "{{ $rol_usuario }}"></home-component>
@endsection --}}

@extends('layouts.app')

@section('content') 
<home-component></home-component>
@endsection