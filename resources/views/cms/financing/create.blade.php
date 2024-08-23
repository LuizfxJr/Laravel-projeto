@extends('layouts.cms')
@section('title', 'Financiamento')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.financing.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Financiamento</h1>
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
                        <h3 class="card-title ">Cadastro de Financiamento</h3>
                    </div>
                    <form method="POST" action="{{route('cms.financing.store')}}" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" placeholder="Valor do Bem" value="{{old('client_id', $client->id)}}" autocomplete="off">
                                        @if ($errors->has('client_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('client_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" placeholder="Valor do Bem" value="{{old('user_id', Auth::user()->id)}}" autocomplete="off">
                                        @if ($errors->has('user_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Bem do Financiamento*</label>
                                        <select name="type_financing" id="type_financing" class="form-control  @error('type_financing') is-invalid @enderror">
                                            <option value="">Bem do Financiamento</option>
                                            @foreach($type_financing as $item)
                                            <option value="{{$item}}" {{old('type_financing')== $item?'selected':''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_financing'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('type_financing') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Estado do Bem*</label>
                                        <select name="type_product" id="type_product" class="form-control  @error('type_product') is-invalid @enderror">
                                            <option value="">Estado do Bem</option>
                                            @foreach($type_product as $item)
                                            <option value="{{$item}}" {{old('type_product')== $item?'selected':''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_product'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('type_product') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Valor do Bem</label>
                                        <input type="text" class="form-control @error('value_product') is-invalid @enderror" id="value_product" name="value_product" placeholder="Valor do Bem" value="{{old('value_product')}}" autocomplete="off">
                                        @if ($errors->has('value_product'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('value_product') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Entrada</label>
                                        <input type="text" class="form-control @error('cash_entry') is-invalid @enderror" id="cash_entry" name="cash_entry" placeholder="Entrada" value="{{old('cash_entry')}}" autocomplete="off">
                                        @if ($errors->has('cash_entry'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cash_entry') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Banco</label>
                                        <input type="text" class="form-control @error('bank_1') is-invalid @enderror" id="bank_1" name="bank_1" placeholder="Banco" value="{{old('bank_1')}}" autocomplete="off">
                                        @if ($errors->has('bank_1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('bank_1') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Agência</label>
                                        <input type="text" class="form-control @error('agency_1') is-invalid @enderror" id="agency_1" name="agency_1" placeholder="Agência" value="{{old('agency_1')}}" autocomplete="off">
                                        @if ($errors->has('agency_1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('agency_1') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Conta</label>
                                        <input type="text" class="form-control @error('account_1') is-invalid @enderror" id="account_1" name="account_1" placeholder="Conta" value="{{old('account_1')}}" autocomplete="off">
                                        @if ($errors->has('account_1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('account_1') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tipo de Conta*</label>
                                        <select name="type_account_1" id="type_account_1" class="form-control  @error('type_account_1') is-invalid @enderror">
                                            <option value="">Tipo de Conta</option>
                                            @foreach($type_account as $item)
                                            <option value="{{$item}}" {{old('type_account_1')== $item?'selected':''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_account_1'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('type_account_1') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Banco</label>
                                        <input type="text" class="form-control @error('bank_2') is-invalid @enderror" id="bank_2" name="bank_2" placeholder="Banco" value="{{old('bank_2')}}" autocomplete="off">
                                        @if ($errors->has('bank_2'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('bank_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Agência</label>
                                        <input type="text" class="form-control @error('agency_2') is-invalid @enderror" id="agency_2" name="agency_2" placeholder="Agência" value="{{old('agency_2')}}" autocomplete="off">
                                        @if ($errors->has('agency_2'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('agency_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Conta</label>
                                        <input type="text" class="form-control @error('account_2') is-invalid @enderror" id="account_2" name="account_2" placeholder="Conta" value="{{old('account_2')}}" autocomplete="off">
                                        @if ($errors->has('account_2'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('account_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tipo de Conta*</label>
                                        <select name="type_account_2" id="type_account_2" class="form-control  @error('type_account_2') is-invalid @enderror">
                                            <option value="">Tipo de Conta</option>
                                            @foreach($type_account as $item)
                                            <option value="{{$item}}" {{old('type_account_2')== $item?'selected':''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_account_2'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('type_account_2') }}</strong>
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
                                        <label class="custom-file-label" for="customFile">IR</label>
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
                            <a href="{{route('cms.financing.index')}}" class="btn btn-default float-right">Cancelar</a>
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