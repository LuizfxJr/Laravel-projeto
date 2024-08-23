@extends('layouts.cms')
@section('title', 'Colaborador')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.collaborator.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Colaboradores</h1>
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
                        <h3 class="card-title ">Relatório de colaborador</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <img src="{{ $user->image_url }}" class="img-thumbnail" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>ID Usuário</label>
                                                    <br />
                                                    <p>{{$user->code}}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Nome Completo</label>
                                                <br />
                                                <p>{{$user->name}}</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Cargo ou função</label>
                                                <br />
                                                @foreach ($occupations as $item)
                                                @if ($item->id === $user->occupation_id)
                                                <p>{{$item->description}}</p>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Setor</label>
                                                    <br />

                                                    @foreach ($sectors as $item)
                                                    @if ($item->id === $user->sector_id)
                                                    <p>{{$item->description}}</p>
                                                    @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nível de usuário</label>
                                                    <br />
                                                    <p>{{$user->user_level}}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Email</label>
                                                <div class="form-group">
                                                    {{$user->email}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($user->description)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Informações adicionais</label>
                                            <br />
                                            <p>{{$user->description}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('cms.collaborator.index')}}" class="btn btn-default float-right">Voltar</a>
                    <a onClick="window.print()" class="btn btn-dark float-right mr-2">Baixar/Imprimir</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop