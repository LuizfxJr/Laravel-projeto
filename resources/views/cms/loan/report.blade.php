@extends('layouts.cms')
@section('title', 'Equipamento')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.equipment.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Equipamentos</h1>
    </div>
</div>
@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <i class="fas fa-solid fa-toolbox float-right"></i>
                        <h3 class="card-title ">Relatório de equipamentos</h3>
                    </div>
                    <form method="POST" action="{{route('cms.equipment.update', $equipment->id)}}" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $equipment->id }}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo de Equipamento</label>
                                                <br />
                                                <p>{{$equipment->equipment_type->description}}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Nome do Equipamento</label>
                                                <br />
                                                <p>{{$equipment->name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Data de cadastro</label>
                                            <br />
                                            <p>{{Carbon\Carbon::parse($equipment->register_date)->format('d/m/Y')}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Fornecedor</label>
                                                <br />
                                                <p>{{$equipment->provider ? $equipment->provider : 'Sem registros'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Setor de Alocação</label>
                                                <br />
                                                <p>{{$equipment->sector_allocation->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Fotos do equipamento</label>
                                            <div class="form-group">
                                                @foreach ($equipment_image as $item)
                                                <img src="{{ $item->image_url }}" class="img-thumbnail img-report" alt="">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @if ($equipment->description)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Informações adicionais</label>
                                                <br />
                                                <p>{{$equipment->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('cms.equipment.index')}}" class="btn btn-default float-right">Voltar</a>
                    <a onClick="window.print()" class="btn btn-dark float-right mr-2">Baixar/Imprimir</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
@stop