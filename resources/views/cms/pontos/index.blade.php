@extends('layouts.cms')

@section('title', 'Financiamento')
@section('content_header')
<h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Financiamento</h1>
@stop
@section('content')
<div class="container">
    @can('view_collaborator')
    <div class="card-body">
        <div class="row">
            <form>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="colaborador_id">Colaborador:</label>
                        <select class="form-control" id="colaborador_id" name="collaborator_id">
                            @foreach ($collaborators as $colaborador)
                            <option value="{{ $colaborador->id }}" @if ($colaborador->id == request('colaborador_id')) selected @endif>
                                {{ $colaborador->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="mes">Mês:</label>
                        <select class="form-control" id="mes" name="mes">
                            <option value="">Todos</option>
                            @php
                            $selectedMonth = request('mes');
                            $selectedYear = request('ano', date('Y'));
                            $currentYear = date('Y');
                            $startMonth = ($selectedYear == $currentYear) ? date('n') : 1;
                            $endMonth = ($selectedYear == $currentYear) ? 12 : 13;
                            @endphp
                            @for ($month = $startMonth; $month < $endMonth; $month++) @php $date=\Carbon\Carbon::create($selectedYear, $month, 1); $optionValue=$date->format('Y-m');
                                @endphp
                                <option value="{{ $optionValue }}" @if ($optionValue==$selectedMonth) selected @endif>
                                    {{ $date->format('F') }}
                                </option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group col-auto">
                        <label for="mes"></label>
                        <button type="submit" class="form-control btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endcan
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('Pontos') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Entrada</th>
                                <th>Intervalo Saída</th>
                                <th>Intervalo Volta</th>
                                <th>Saída</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pontos->isEmpty() || !$pontos->first()->data->isToday())
                            <form action="{{ route('cms.pontos.store') }}" method="POST" style="display:inline-block;">
                                @csrf
                                <input type="hidden" name="tipo" value="hora_entrada">
                                <button type="submit" class="btn btn-primary">Bater Ponto</button>
                            </form>
                            @endif
                            @foreach($pontos as $ponto)
                            <tr>
                                <td>{{ $ponto->data->format('d/m/Y') }}</td>

                                <td>{{ $ponto->hora_entrada ? $ponto->hora_entrada->format('H:i:s') : '-' }}</td>

                                <td>{{ $ponto->hora_intervalo_saida ? $ponto->hora_intervalo_saida->format('H:i:s') : '-' }}</td>

                                <td>{{ $ponto->hora_intervalo_volta ? $ponto->hora_intervalo_volta->format('H:i:s') : '-' }}</td>

                                <td>{{ $ponto->hora_saida ? $ponto->hora_saida->format('H:i:s') : '-' }}</td>

                                <td>
                                    @if(!$ponto->hora_entrada || count($pontos) === 0)
                                    <form action="{{ route('cms.pontos.store') }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="tipo" value="hora_entrada">
                                        <button type="submit" class="btn btn-primary">Entrada</button>
                                    </form>
                                    @elseif(!$ponto->hora_intervalo_saida)
                                    <form action="{{ route('cms.pontos.update', $ponto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="tipo" value="hora_intervalo_saida">
                                        <button type="submit" class="btn btn-warning">Intervalo Saída</button>
                                    </form>
                                    @elseif(!$ponto->hora_intervalo_volta)
                                    <form action="{{ route('cms.pontos.update', $ponto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="tipo" value="hora_intervalo_volta">
                                        <button type="submit" class="btn btn-success">Intervalo Volta</button>
                                    </form>
                                    @elseif(!$ponto->hora_saida)
                                    <form action="{{ route('cms.pontos.update', $ponto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="tipo" value="hora_saida">
                                        <button type="submit" class="btn btn-danger">Saída</button>
                                    </form>
                                    @else
                                    @can('view_collaborator')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarModal{{ $ponto->id }}">Editar</button>
                                    @endcan
                                    @endif
                                </td>
                                <td>
                                    <div class="modal fade" id="editarModal{{ $ponto->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModal{{ $ponto->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Ponto - {{ $ponto->data->format('d/m/Y') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('cms.pontos.update', $ponto->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group row">
                                                            <label for="hora_entrada" class="col-md-4 col-form-label text-md-right">{{ __('Hora de Entrada') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="hora_entrada" type="time" class="form-control @error('hora_entrada') is-invalid @enderror" name="hora_entrada" value="{{ old('hora_entrada', optional($ponto->hora_entrada)->format('H:i')) }}" autofocus>
                                                                @error('hora_entrada')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="hora_intervalo_saida" class="col-md-4 col-form-label text-md-right">{{ __('Hora de Saída para Intervalo') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="hora_intervalo_saida" type="time" class="form-control @error('hora_intervalo_saida') is-invalid @enderror" name="hora_intervalo_saida" value="{{ old('hora_intervalo_saida', optional($ponto->hora_intervalo_saida)->format('H:i')) }}">
                                                                @error('hora_intervalo_saida')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="hora_intervalo_volta" class="col-md-4 col-form-label text-md-right">{{ __('Hora de Volta do Intervalo') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="hora_intervalo_volta" type="time" class="form-control @error('hora_intervalo_volta') is-invalid @enderror" name="hora_intervalo_volta" value="{{ old('hora_intervalo_volta', optional($ponto->hora_intervalo_volta)->format('H:i')) }}">
                                                                @error('hora_intervalo_volta')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="hora_saida" class="col-md-4 col-form-label text-md-right">{{ __('Hora de Saída') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="hora_saida" type="time" class="form-control @error('hora_saida') is-invalid @enderror" name="hora_saida" value="{{ old('hora_saida', optional($ponto->hora_saida)->format('H:i')) }}">
                                                                @error('hora_saida')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total de horas trabalhadas no mês:</td>
                                @if(isset($horas_trabalhadas_mes[0]))
                                <td>{{ gmdate('H:i',  $horas_trabalhadas_mes[0]->segundos) }}</td>
                                @else
                                <td>0</td>
                                @endif

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection