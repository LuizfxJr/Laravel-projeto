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
                    <select class="form-control" name="user" id="">
                        <option value="">Atendente</option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                        <th>Ação</th>
                        <th>Usuário</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($financingsLogs) > 0)
                    @foreach ($financingsLogs as $item)
                    <tr class="odd">
                        <td>{{$item->action}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                    @endforeach
                    @else
                    <td valign="top" colspan="12" class="dataTables_empty" style="text-align: center"><b>Nenhum
                            registro
                            encontrado</b></td>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
    @endsection