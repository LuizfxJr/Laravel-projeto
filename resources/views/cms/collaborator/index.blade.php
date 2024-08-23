@extends('layouts.cms')

@section('title', 'Colaboradores')
@section('content_header')
<h1><i class="fas fa-address-card">&nbsp;</i>Colaboradores</h1>
@stop
@section('content')
<div class="card card-outline card-primary table-responsive">
    <div class="card-body">
        <div class="row">
            <div class="col-auto">
                <a href="{{ route('cms.collaborator.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                    Inserir Colaborador</a>
            </div>
        </div>
        <br>
        <form>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input name="search" placeholder="Buscar colaborador" class="form-control" value="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select class="form-control" name="occupation_search" id="">
                            <option value="">Cargo ou Função</option>
                            @foreach ($occupations as $occupation)
                            <option value="{{ $occupation->id }}">{{ $occupation->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select class="form-control" name="sector_search" id="">
                            <option value="">Setor</option>
                            @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->description }}</option>
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
                        <th>ID Usuario</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cargo ou Função</th>
                        <th>Setor</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                    @foreach ($users as $item)
                    <tr class="odd">
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->occupation->description }}</td>
                        <td>{{ $item->sector->description }}</td>
                        <td>
                            @can('edit_register')
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.collaborator.edit', $item->id) }}"><i class="far fa-edit"></i> editar</a>
                            @endcan
                            @can('delete_register')
                            <form method="POST" action="{{ route('cms.collaborator.destroy', $item->id) }}" style="display: inline" onsubmit="return confirm('Deseja remover esse colaborador?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i>
                                    deletar</button>
                            </form>
                            @endcan
                            <a class="btn btn-primary btn-sm" href="{{ route('cms.collaborator.report', $item->id)}}"><i class="far fa-file"></i> Visualizar</a>
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
                {{$users->links()}}
            </div>
            <div class="d-flex justify-content-center">
                <b>Total de {{ $users->total() }} registro(s)</b>
            </div>

        </div>

    </div>
</div>

@endsection