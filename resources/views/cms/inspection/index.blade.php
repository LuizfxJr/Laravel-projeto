@extends('layouts.cms')

@section('title', 'Inspeção')
@section('content_header')
<h1><i class="fa fa-edit">&nbsp;</i>Inspeção</h1>
@stop
@section('content')
<div class="card card-outline card-primary table-responsive">
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" onfocus="(this.type='date')" placeholder="Data inicial" name="search_date_initial" placeholder="Data" class="form-control" value="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" onfocus="(this.type='date')" placeholder="Data final" name="search_date_finally" placeholder="Data" class="form-control" value="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input name="search_name" placeholder="Usuário" class="form-control" value="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input name="search_company" placeholder="Empresa" class="form-control" value="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <select class="form-control" name="search_equipment" id="">
                            <option value="">Equipamento Inspecionado</option>
                            @foreach ($equipments as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <th>Usuário</th>
                        <th>Empresa</th>
                        <th>Equipamento Inspecionado</th>
                        <th>Data</th>
                        <th>Categoria</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($inspections) > 0)
                    @foreach ($inspections as $item)
                    <tr class="odd">
                        <td>{{$item->name}}</td>
                        <td>{{$item->company}}</td>
                        <td>{{$item->equipment->name}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->inspect_category->description}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.inspection.report', $item->id)}}"><i class="far fa-file"></i> Visualizar</a>
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
                {{$inspections->links()}}
            </div>
            <div class="d-flex justify-content-center">
                <b>Total de {{ $inspections->total() }} registro(s)</b>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <a href="{{ route('cms.inspection.exportCSV') }}" class="btn btn-dark float-right mr-2">Baixar CSV</a>
    </div>
</div>
@endsection