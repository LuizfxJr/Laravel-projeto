@extends('adminlte::master')
@section('js')
@component('cms.components.toast')@endcomponent
@yield('custom-js')
@yield('page-script')
@endsection
@section('right-sidebar')