@extends('layouts.app')

@section('content') 
    <talentos-component id_usuario_logeado = "{{ auth()->user()->id }}" name_usuario_logeado = "{{ auth()->user()->name }}" rol_usuario = "{{ $rol_usuario }}" sede = "{{ $sede }}" permisos="{{json_encode($permisos)}}" componente="TalentosAMFpro"></talentos-component >
@endsection
