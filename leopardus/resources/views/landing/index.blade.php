@extends('layouts.landing')

@section('content')
{{-- Nuestra Empresa --}}
@include('landing.component.nuestraEmpresa')
{{-- Fin Nuestra Empresa --}}
{{-- Nuestra Equipo --}}
@include('landing.component.nuestroEquipo')
{{-- Fin Nuestra Equipo --}}
{{-- Servicios --}}
@include('landing.component.servicios')
{{-- Fin Servicios --}}
@endsection