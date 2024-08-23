@extends('layouts.cms')
@section('title', 'Inspeção')
@section('body')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <i class="fas fa-solid fa-toolbox float-right"></i>
                        <h3 class="card-title ">Checklist de Inspeção</h3>
                    </div>
                    <form method="POST" action="{{route('web.inspection.store')}}" enctype="multipart/form-data">
                        <div class="card-body">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>ID do Usuário*</label>
                                        <input type="text" class="form-control @error('id_user') is-invalid @enderror" id="id_user" name="id_user" placeholder="ID do Usuário" value="{{old('id_user')}}" autocomplete="off">
                                        @if ($errors->has('id_user'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('id_user') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Nome do Usuário*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome do Usuário" value="{{old('name')}}" autocomplete="off">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Empresa*</label>
                                        <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" placeholder="Empresa" value="{{old('company')}}" autocomplete="off">
                                        @if ($errors->has('company'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Data*</label>
                                    <div class="form-group">
                                        <input type="date" id="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" placeholder="Data" value="{{old('date')}}">
                                        @if ($errors->has('date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Hora*</label>
                                    <div class="form-group">
                                        <input type="time" id="hour" class="form-control @error('hour') is-invalid @enderror" id="hour" name="hour" placeholder="Hora" value="{{old('hour')}}">
                                        @if ($errors->has('hour'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('hour') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Equipamento Inspecionado*</label>
                                        <select name="equipment_id" id="equipment" class="form-control  @error('equipment') is-invalid @enderror">
                                            <option value="">Equipamento Inspecionado</option>
                                            @foreach ($equipment as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('equipment'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('equipment') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Natureza da Atividade*</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('nature_activity') is-invalid @enderror" id="nature_activity" name="nature_activity" placeholder="Empresa" value="{{old('nature_activity')}}" autocomplete="off">
                                        @if ($errors->has('nature_activity'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('nature_activity') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Categoria*</label>
                                        <select name="inspect_category_id" id="inspect_category" class="form-control  @error('inspect_category') is-invalid @enderror">
                                            <option value="">Categoria</option>
                                            @foreach ($inspect_categories as $item)
                                            <option value="{{$item->id}}">{{$item->description}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('inspect_category'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('inspect_category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Descrição*</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Empresa" value="{{old('description')}}" autocomplete="off">
                                        @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <div class="form-group">
                                        <label>Ações Tomadas*</label>
                                        <textarea id="action_taken" class="form-control @error('action_taken') is-invalid @enderror" id="action_taken" name="action_taken" placeholder="Ações Tomadas" value="{{old('action_taken')}}" rows="3"></textarea>
                                        @if ($errors->has('action_taken'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('action_taken') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Informações adicionais*</label>
                                        <textarea id="additional_information" class="form-control @error('additional_information') is-invalid @enderror" id="additional_information" name="additional_information" placeholder="Informações adicionais" value="{{old('additional_information')}}" rows="3"></textarea>
                                        @if ($errors->has('additional_information'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('additional_information') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Prazo*</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" placeholder="Prazo" value="{{old('deadline')}}" autocomplete="off">
                                        @if ($errors->has('deadline'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('deadline') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Fotos da Inspeção</label>
                                        <div class="custom-file">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror custom-file-input" id="image" name="image[]" multiple='multiple'>
                                            <label class="custom-file-label" for="customFile">Adicionar Fotos</label>
                                        </div>
                                        @if ($errors->has('image'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="display:flex; justify-content:end;">
                            <label for="">&nbsp</label>
                            <button type="submit" class="btn btn-primary">Enviar Checklist</button>
                            <label for="">&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                            <a href="{{route('web.inspection.create')}}" class="btn btn-danger float-right">Limpar dados</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop