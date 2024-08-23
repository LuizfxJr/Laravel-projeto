@extends('layouts.cms')
@section('title', 'Inspeção')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.inspection.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Inspeção</h1>
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
                        <h3 class="card-title ">Relatório individualizado de inspeção</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>ID do Usuário</label>
                                            <br />
                                            <p>{{$inspection->id_user}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Nome do Usuário</label>
                                        <br />
                                        <p>{{$inspection->name}}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Empresa</label>
                                        <br />
                                        <p>{{$inspection->company}}</p>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Data</label>
                                            <br />
                                            <p>{{$inspection->date}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Hora</label>
                                            <br />
                                            <p>{{$inspection->hour}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Equipamento Inspecionado</label>
                                        <div class="form-group">
                                            {{$inspection->equipment->name}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Natureza da Atividade</label>
                                            <br />
                                            <p>{{$inspection->nature_activity}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <br />
                                            <p>{{$inspection->inspect_category->description}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Descrição</label>
                                        <div class="form-group">
                                            {{$inspection->description}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 2rem;">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ação Tomada</label>
                                            <br />
                                            <p>{{$inspection->action_taken}}</p>
                                        </div>
                                    </div>
                                    @if ($inspection->additional_information)
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Informações adicionais</label>
                                            <br />
                                            <p>{{$inspection->additional_information}}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row" style="margin-top: 2rem;">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Prazo</label>
                                            <br />
                                            <p>{{$inspection->deadline}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Imagens Capturadas</label>
                                        <div class="form-group">
                                            @foreach ($inspection_image as $item)
                                            <img src="{{ $item->image_url }}" class="img-thumbnail img-report" alt="">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('cms.equipment.index')}}" class="btn btn-default float-right">Voltar</a>
                    <a onClick="window.print()" class="btn btn-dark float-right mr-2">Baixar/Imprimir</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop