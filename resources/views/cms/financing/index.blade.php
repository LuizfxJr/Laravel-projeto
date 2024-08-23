@extends('layouts.cms')

@section('title', 'Financiamento')
@section('content_header')
<h1><i class="fas fa-solid fa-landmark">&nbsp;</i>Financiamento</h1>
@stop
@section('content')
<div class="card card-outline card-primary table-responsive">
    <div class="card-body">
        <br>
        <form>
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control select2bs4" name="status" id="">
                        <option value="">Cliente</option>
                        @foreach ($clients as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="user" id="">
                        <option value="">Atendente</option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="status" id="">
                        <option value="">Status</option>
                        @foreach ($status as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">

                    <div class="form-group">
                        <button id="consultar" type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search-plus"></i> Consultar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row table-responsive">
        <div class="col-sm-12">
            <table class="table table-hover text-nowrap dataTable no-footer" role="grid" style="width: 99%; margin-left:auto; margin-right: auto">
                <thead class="bg-primary-2">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Bem</th>
                        <th>Data</th>
                        <th>Atendente</th>
                        <th>Conclusão</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($financings) > 0)
                    @foreach ($financings as $item)
                    <tr class="odd">
                        <td>{{$item->client->name}}</td>
                        <td>{{$item->client->phone}}</td>
                        <td>{{$item->type_financing}}</td>
                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->conclusion ? $item->conclusion : '-'}}</td>

                        @if($item->status === 'Novo')
                        <td>
                            <span class="btn btn-primary btn-sm">{{$item->status}}</span>
                        </td>
                        @elseif($item->status === 'Análise Interna' && $item->status_color === 'alert')
                        <td>
                            <span class="btn btn-warning btn-sm">{{$item->status}}</span>
                        </td>
                        @elseif($item->status === 'Análise Interna' && $item->status_color === 'danger')
                        <td>
                            <span class="btn btn-danger btn-sm">{{$item->status}}</span>
                        </td>
                        @elseif($item->status === 'Andamento' && $item->status_color === 'alert')
                        <td>
                            <span class="btn btn-warning btn-sm">{{$item->status}}</span>
                        </td>
                        @elseif($item->status === 'Andamento' && $item->status_color === 'danger')
                        <td>
                            <span class="btn btn-danger btn-sm">{{$item->status}}</span>
                        </td>
                        @elseif($item->status === 'Negado')
                        <td>
                            <span class="btn btn-danger btn-sm">{{$item->status}}</span>
                        </td>
                        @else
                        <td>
                            <span class="btn btn-success btn-sm">{{$item->status}}</span>
                        </td>
                        @endif
                        <td>
                            @can('edit_register')
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.financing.edit', $item->id)}}"><i class="far fa-edit"></i> Atualizar</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.financing.historic', $item->id)}}"><i class="fa fa-file"></i> Histórico</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td valign="top" colspan="12" class="dataTables_empty" style="text-align: center"><b>Nenhum
                            registro
                            encontrado</b></td>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$financings->links()}}
            </div>
            <div class="d-flex justify-content-center">
                <b>Total de {{ $financings->total() }} registro(s)</b>
            </div>
        </div>

    </div>
    @endsection