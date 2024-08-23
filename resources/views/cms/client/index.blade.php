@extends('layouts.cms')

@section('title', 'Clientes')
@section('content_header')
<h1><i class="fas fa-solid fa-users">&nbsp;</i>Clientes</h1>
@stop
@section('content')
<div class="card card-outline card-primary table-responsive">
    <div class="card-body">
        <div class="row">
            <div class="col-auto">
                <a href="{{ route('cms.client.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Inserir Cliente</a>
            </div>
        </div>
        <br>
        <form>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input name="search" placeholder="Buscar por nome" class="form-control" value="">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <input name="search_cpf" id="search_cpf" placeholder="Buscar por CPF" class="form-control" value="">
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
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Data Nascimento</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($clients) > 0)
                    @foreach ($clients as $item)
                    <tr class="odd">
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->cpf}}</td>
                        <td>{{Carbon\Carbon::parse($item->birth_date)->format('d/m/Y')}}</td>
                        <td>
                            @can('edit_register')
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.client.edit', $item->id)}}"><i class="far fa-edit"></i> Editar</a>
                            @endcan
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.financing.consulta', $item->id)}}"><i class="fas fa-landmark"></i> Financiamento</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.loan.consulta', $item->id)}}"><i class="fas fa-wallet"></i> Emprestimo</a>

                            

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
                {{$clients->links()}}
            </div>
            <div class="d-flex justify-content-center">
                <b>Total de {{ $clients->total() }} registro(s)</b>
            </div>
        </div>

    </div>
</div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        $('#search_cpf').mask('000.000.000-00', {
            reverse: true
        });
    });
</script>
@endsection