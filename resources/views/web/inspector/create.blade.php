@extends('layouts.cms')
@section('title', 'Cadastro de Inspetor')
@section('body')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <i class="fas fa-solid fa-toolbox float-right"></i>
                        <h3 class="card-title ">Cadastro de Inspetor</h3>
                    </div>
                    <form method="POST" action="{{route('web.inspector.store')}}" enctype="multipart/form-data">
                        <div class="card-body">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Matricula*</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('registration') is-invalid @enderror" id="registration" name="registration" placeholder="Matricula" value="{{old('registration')}}" autocomplete="off">
                                        @if ($errors->has('registration'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('registration') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nome*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome" value="{{old('name')}}" autocomplete="off">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Função*</label>
                                        <input type="text" class="form-control @error('function') is-invalid @enderror" id="function" name="function" placeholder="Função" value="{{old('function')}}" autocomplete="off">
                                        @if ($errors->has('function'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('function') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Empresa*</label>
                                        <select class="form-control" name="company_id" id="company_id">
                                            <option value="">Empresa</option>
                                            @foreach ($companies as $item)
                                            <option value="{{$item->id}}" {{$item->id==old('company_id') ? 'selected' : ''}}>{{$item->description}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('company_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="display:flex; justify-content:end;">
                            <label for="">&nbsp</label>
                            <button type="submit" class="btn btn-primary">Enviar Cadastro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop