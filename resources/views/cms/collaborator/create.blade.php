@extends('layouts.cms')
@section('title', 'Colaborador')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.collaborator.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-address-card">&nbsp;</i>Colaboradores</h1>
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
                            <i class="fas fa-address-card float-right"></i>
                            <h3 class="card-title ">Cadastro de colaborador</h3>
                        </div>
                        <form method="POST" action="{{route('cms.collaborator.store')}}" enctype="multipart/form-data">
                            <div class="card-body table">
                                @method('POST')
                                @csrf
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Código</label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                                                placeholder="Codigo do usuario" value="{{old('code')}}" autocomplete="off">
                                            @if ($errors->has('code'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label>Nome completo*</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                                placeholder="Nome completo" value="{{old('name')}}" autocomplete="off">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Cargo ou função*</label>
                                            <select name="occupation_id" id="occupation_id" class="form-control  @error('occupation_id') is-invalid @enderror">
                                                <option value="">Cargo ou Função</option>
                                                @foreach ($occupations as $item)
                                                    <option value="{{$item->id}}"  {{old('occupation_id')== $item->id?'selected':''}}>{{$item->description}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('occupation_id'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('occupation_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Setor*</label>
                                            <select name="sector_id" id="sector_id" class="form-control  @error('sector_id') is-invalid @enderror">
                                                <option value="">Setor</option>
                                                @foreach ($sectors as $item)
                                                    <option value="{{$item->id}}" {{old('sector_id')== $item->id?'selected':''}}>{{$item->description}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sector_id'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('sector_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Nível de usuário*</label>
                                            <select name="user_level" id="user_level" class="form-control  @error('user_level') is-invalid @enderror">
                                                <option value="">Nível de usuário</option>
                                                @foreach($user_levels as $item)
                                                 @if(auth()->user()->user_level == 'supervisor' && $item == 'administrator')
                                                    @continue
                                                 @endif
                                                    <option value="{{$item}}" {{old('user_level')== $item?'selected':''}}>{{trans("cms.collaborator.form.$item")}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user_level'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('user_level') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Senha*</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                                placeholder="{{ __('adminlte::adminlte.password') }}">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Confirmar Senha*</label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Informações adicionais</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                placeholder="Informações adicionais" value="{{old('description')}}" rows="3"></textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label><small>Foto de perfil</small></label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                   id="image" name="image">
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Inserir</button>
                                <a href="{{route('cms.collaborator.index')}}" class="btn btn-default float-right">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop