@extends('adminlte::page')
@section('js')
@component('cms.components.toast')@endcomponent
@yield('custom-js')
@yield('page-script')
@endsection