@extends('layouts.cms')

@section('title', 'Registro de Ponto')
@section('content_header')
<h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Registro de Ponto</h1>
@stop
@section('content')

<div class="card card-outline card-primary table-responsive">
    <div class="card-header">{{ __('Pontos') }}</div>

    <div class="card-body">
        @foreach($pontos as $ponto)
        <h2>Mês: {{ $ponto->month }}/{{ $ponto->year }}</h2>
        <p>Horas trabalhadas: {{ gmdate('H:i:s', $ponto->segundos) }}</p>
        @endforeach
    </div>
</div>

@endsection