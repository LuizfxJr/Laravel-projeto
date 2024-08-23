@extends('layouts.cms')
@section('title', 'Dashboard')
@section('content_header')
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@stack('scripts')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <h2>Bem vindo, {{Auth::user()->name}}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <form>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="start_date">Início:</label>
                                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="end_date">Término:</label>
                                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="end_date">Atendente:</label>
                                                <select class="form-control" name="user" id="">
                                                    <option value="">Atendente</option>
                                                    @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-group">
                                                    <label for="end_date">&nbsp;</label>
                                                    <button id="consultar" type="submit" class="form-control btn btn-outline-primary">
                                                        <i class="fas fa-search-plus"></i> Consultar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @can('view_collaborator')
                                <div class="row">
                                    <div class="col-md-4 col-xl-2">
                                        <h4>Financiamentos</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#4099ff,#73b4ff);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fas fa-plus">&nbsp;</i><span>{{$financings[0]->novo}}</span></h3>
                                                <p class="m-b-0">Novos</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#2ed8b6,#59e0c5);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fas fa-solid fa-calculator">&nbsp;</i><span>{{$financings[0]->simulacao}}</span></h3>
                                                <p class="m-b-0">em Simulação</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#3dff00,#37d111);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fas fa-check">&nbsp;</i><span>{{$financings[0]->preaprovado}}</span></h3>
                                                <p class="m-b-0">Pré Aprovados</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#2ed8b6,#59e0c5);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fa fa-tasks">&nbsp;</i><span>{{$financings[0]->andamento}}</span></h3>
                                                <p class="m-b-0">em Andamento</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#3dff00,#37d111);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fas fa-check">&nbsp;</i><span>{{$financings[0]->aprovado}}</span></h3>
                                                <p class="m-b-0">Aprovados</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#2ed8b6,#59e0c5);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fa fa-tasks">&nbsp;</i><span>{{$financings[0]->andamentoPos}}</span></h3>
                                                <p class="m-b-0">em Finalização</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#2ed8b6,#59e0c5);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fa fa-tasks">&nbsp;</i><span>{{$financings[0]->finalizado}}</span></h3>
                                                <p class="m-b-0">Finalizados</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#FF5370,#ff869a);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Financiamentos</h6>
                                                <h3><i class="fas fa-times">&nbsp;</i><span>{{$financings[0]->recusado}}</span></h3>
                                                <p class="m-b-0">Recusados</p>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <br />
                                <div class="row">
                                    <div class="col-md-4 col-xl-2">
                                        <h4>Empréstimos</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#4099ff,#73b4ff);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Empréstimos</h6>
                                                <h3><i class="fas fa-plus">&nbsp;</i><span>{{$loans[0]->novo}}</span></h3>
                                                <p class="m-b-0">Novos</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#2ed8b6,#59e0c5);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Empréstimos</h6>
                                                <h3><i class="fas fa-solid fa-calculator">&nbsp;</i><span>{{$loans[0]->simulacao}}</span></h3>
                                                <p class="m-b-0">em Simulação</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#2ed8b6,#59e0c5);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Empréstimos</h6>
                                                <h3><i class="fa fa-tasks">&nbsp;</i><span>{{$loans[0]->andamento}}</span></h3>
                                                <p class="m-b-0">em Andamento</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#FF5370,#ff869a);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Empréstimos</h6>
                                                <h3><i class="fas fa-times">&nbsp;</i><span>{{$loans[0]->recusado}}</span></h3>
                                                <p class="m-b-0">Recusados</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#3dff00,#37d111);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Empréstimos</h6>
                                                <h3><i class="fas fa-check">&nbsp;</i><span>{{$loans[0]->aprovado}}</span></h3>
                                                <p class="m-b-0">Aprovados</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br />
                                <div class="row">
                                    <div class="col-md-4 col-xl-2">
                                        <h4>Imóveis</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#4099ff,#73b4ff);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Imóveis</h6>
                                                <h3><i class="fas fa-plus">&nbsp;</i><span>{{$loans[0]->novo}}</span></h3>
                                                <p class="m-b-0">Ativos</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xl-2">
                                        <div class="card order-card" style="padding-top: 10px; background: linear-gradient(45deg,#3dff00,#37d111);">
                                            <div class="card-block" style="text-align: center;">
                                                <h6 class="m-b-20">Imóveis</h6>
                                                <h3><i class="fas fa-check">&nbsp;</i><span>{{$properties[0]->vendido}}</span></h3>
                                                <p class="m-b-0">Vendidos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection