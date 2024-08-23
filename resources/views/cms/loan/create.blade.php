@extends('layouts.cms')
@section('title', 'Empréstimo')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.loan.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Empréstimo</h1>
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
                        <h3 class="card-title ">Cadastro de Empréstimo</h3>
                    </div>
                    <form method="POST" action="{{route('cms.loan.store')}}" enctype="multipart/form-data">
                        <div class="card-body">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <br />
                                        <p>{{$client->name}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <br />
                                        <p>{{$client->cpf}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <br />
                                        <p>{{$client->rg}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <br />
                                        <p>{{$client->email}}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-3 input-client">
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $client->id)}}" autocomplete="off">
                                        @if ($errors->has('client_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('client_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{old('user_id', Auth::user()->id)}}" autocomplete="off">
                                        @if ($errors->has('user_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tipo de Consignado*</label>
                                        <input type="text" class="form-control @error('consigned_type') is-invalid @enderror" id="consigned_type" name="consigned_type" placeholder="Tipo de Consignado" value="{{old('consigned_type')}}" autocomplete="off">
                                        @if ($errors->has('consigned_type'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('consigned_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Valor Beneficio/Renda*</label>
                                        <input type="text" class="form-control @error('consigned_value') is-invalid @enderror" id="consigned_value" name="consigned_value" placeholder="Valor Beneficio/Renda" value="{{old('consigned_value')}}" autocomplete="off">
                                        @if ($errors->has('consigned_value'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('consigned_value') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Espécie do Beneficio</label>
                                        <input type="text" class="form-control @error('kind_benefit') is-invalid @enderror" id="kind_benefit" name="kind_benefit" placeholder="Espécie do Beneficio" value="{{old('kind_benefit')}}" autocomplete="off">
                                        @if ($errors->has('kind_benefit'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('kind_benefit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>N° Beneficio/Matricula</label>
                                        <input type="text" class="form-control @error('registration') is-invalid @enderror" id="registration" name="registration" placeholder="N° Beneficio/Matricula" value="{{old('registration')}}" autocomplete="off">
                                        @if ($errors->has('registration'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('registration') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Margem</label>
                                        <input type="text" class="form-control @error('margin') is-invalid @enderror" id="margin" name="margin" placeholder="Entrada" value="{{old('margin')}}" autocomplete="off">
                                        @if ($errors->has('margin'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('margin') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Banco</label>
                                        <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank" name="bank" placeholder="Banco" value="{{old('bank')}}" autocomplete="off">
                                        @if ($errors->has('bank'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('bank') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Agência</label>
                                        <input type="text" class="form-control @error('agency') is-invalid @enderror" id="agency" name="agency" placeholder="Agência" value="{{old('agency')}}" autocomplete="off">
                                        @if ($errors->has('agency'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('agency') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Conta</label>
                                        <input type="text" class="form-control @error('account') is-invalid @enderror" id="account" name="account" placeholder="Conta" value="{{old('account')}}" autocomplete="off">
                                        @if ($errors->has('account'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('account') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tipo de Conta*</label>
                                        <select name="type_account" id="type_account" class="form-control  @error('type_account') is-invalid @enderror">
                                            <option value="">Tipo de Conta</option>
                                            @foreach($type_account as $item)
                                            <option value="{{$item}}" {{old('type_account')== $item?'selected':''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_account'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('type_account') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <br />
                            <br />
                            <div class="row">
                                <div class="col-2" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('image_1') is-invalid @enderror custom-file-input" id="image_1" name="image_1">
                                        <label class="custom-file-label" for="customFile">CPF</label>
                                        @if ($errors->has('image_1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('image_1') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('image_2') is-invalid @enderror custom-file-input" id="image_2" name="image_2">
                                        <label class="custom-file-label" for="customFile">RG</label>
                                        @if ($errors->has('image_2'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('image_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('image_3') is-invalid @enderror custom-file-input" id="image_3" name="image_3">
                                        <label class="custom-file-label" for="customFile">Comprovante de Residencia</label>
                                        @if ($errors->has('image_3'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('image_3') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('image_4') is-invalid @enderror custom-file-input" id="image_4" name="image_4">
                                        <label class="custom-file-label" for="customFile">Contra Cheque</label>
                                        @if ($errors->has('image_4'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('image_4') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Inserir</button>
                            <a href="{{route('cms.loan.index')}}" class="btn btn-default float-right">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('custom-js')
<script>
    $('.input-client').hide();

    $(document).ready(function() {
        $('#cash_entry').maskMoney({
            prefix: 'R$ ', // Prefixo
            thousands: '.', // Separador de milhares
            decimal: ',', // Separador decimal
            allowZero: true // Permite valor zero
        });
        $('#value_product').maskMoney({
            prefix: 'R$ ', // Prefixo
            thousands: '.', // Separador de milhares
            decimal: ',', // Separador decimal
            allowZero: true // Permite valor zero
        });
    });
</script>
@endsection