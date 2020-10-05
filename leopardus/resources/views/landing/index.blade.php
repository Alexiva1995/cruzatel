@extends('layouts.landing')

@section('content')
{{-- Nuestra Empresa --}}
@include('landing.component.nuestraEmpresa')
{{-- Fin Nuestra Empresa --}}
{{-- Servicios --}}
@include('landing.component.servicios')
{{-- Fin Servicios --}}
{{-- Nuestra Equipo --}}
@include('landing.component.nuestroEquipo')
{{-- Fin Nuestra Equipo --}}
@endsection