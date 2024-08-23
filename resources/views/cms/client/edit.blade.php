@extends('layouts.cms')
@section('title', 'Equipamento')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.client.index')}}" class="btn btn-default">Voltar</a>
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
                        <h3 class="card-title ">Cadastro de equipamento</h3>
                    </div>
                    <form method="POST" action="{{route('cms.client.update', $client->id)}}" enctype="multipart/form-data">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nome*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome do Equipamento" value="{{old('name', $client->name)}}" autocomplete="off">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{old('email', $client->email)}}" autocomplete="off">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Telefone*</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Telefone" value="{{old('phone', $client->phone)}}" autocomplete="off">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>CPF*</label>
                                        <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" placeholder="CPF" value="{{old('cpf', $client->cpf)}}" autocomplete="off">
                                        @if ($errors->has('cpf'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>RG*</label>
                                        <input type="text" class="form-control @error('rg') is-invalid @enderror" id="rg" name="rg" placeholder="RG" value="{{old('rg', $client->rg)}}" autocomplete="off">
                                        @if ($errors->has('rg'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('rg') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Data Expedição*</label>
                                        <input type="date" class="form-control @error('shipping_date') is-invalid @enderror" id="shipping_date" name="shipping_date" placeholder="Data Expedição" value="{{old('shipping_date', $client->shipping_date)}}" autocomplete="off">
                                        @if ($errors->has('shipping_date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('shipping_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Orgão Expedidor*</label>
                                        <input type="text" class="form-control @error('issuing_agency') is-invalid @enderror" id="issuing_agency" name="issuing_agency" placeholder="Orgão Expedidor" value="{{old('issuing_agency', $client->issuing_agency)}}" autocomplete="off">
                                        @if ($errors->has('issuing_agency'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('issuing_agency') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Data Nascimento</label>
                                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" placeholder="Data Nascimento" value="{{old('birth_date', $client->birth_date)}}" autocomplete="off">
                                        @if ($errors->has('birth_date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Estado Civil*</label>
                                        <select name="marital_status" id="marital_status" class="form-control  @error('marital_status') is-invalid @enderror">
                                            <option value="">Nível de usuário</option>
                                            @foreach($marital_status as $item)
                                            <option value="{{$item}}" {{$item==(old('marital_status') ? old('marital_status') : $client->marital_status) ? 'selected' : ''}}>{{trans("cms.collaborator.form.$item")}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('marital_status'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nome da Mãe*</label>
                                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" name="mother_name" placeholder="Nome da Mãe" value="{{old('mother_name', $client->mother_name)}}" autocomplete="off">
                                        @if ($errors->has('mother_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('mother_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Empresa*</label>
                                        <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" placeholder="Empresa" value="{{old('company', $client->company)}}" autocomplete="off">
                                        @if ($errors->has('company'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Regime de trabalho*</label>
                                        <input type="text" class="form-control @error('work_regime') is-invalid @enderror" id="work_regime" name="work_regime" placeholder="Regime de trabalho" value="{{old('work_regime', $client->work_regime)}}" autocomplete="off">
                                        @if ($errors->has('work_regime'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('work_regime') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Profissão</label>
                                        <input type="text" class="form-control @error('profession') is-invalid @enderror" id="profession" name="profession" placeholder="Profissão" value="{{old('profession', $client->profession)}}" autocomplete="off">
                                        @if ($errors->has('profession'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('profession') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Salário Bruto</label>
                                        <input type="text" class="form-control @error('gross_income') is-invalid @enderror" id="gross_income" name="gross_income" placeholder="Salário Bruto" value="{{old('gross_income', $client->gross_income)}}" autocomplete="off">
                                        @if ($errors->has('gross_income'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('gross_income') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Salário Liquído</label>
                                        <input type="text" class="form-control @error('net_income') is-invalid @enderror" id="net_income" name="net_income" placeholder="Salário Liquído" value="{{old('net_income', $client->net_income)}}" autocomplete="off">
                                        @if ($errors->has('net_income'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('net_income') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Data de Admissão*</label>
                                        <input type="date" class="form-control @error('admission_date') is-invalid @enderror" id="admission_date" name="admission_date" placeholder="Data de Admissão" value="{{old('admission_date', $client->admission_date)}}" autocomplete="off">
                                        @if ($errors->has('admission_date'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('admission_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Endereço Residencial*</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Endereço" value="{{old('address', $client->address)}}" autocomplete="off">
                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>Número*</label>
                                        <input type="text" class="form-control @error('address_number') is-invalid @enderror" id="address_number" name="address_number" placeholder="Número" value="{{old('address_number', $client->address_number)}}" autocomplete="off">
                                        @if ($errors->has('address_number'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control @error('address_neighborhood') is-invalid @enderror" id="address_neighborhood" name="address_neighborhood" placeholder="Bairro" value="{{old('address_neighborhood', $client->address_neighborhood)}}" autocomplete="off">
                                        @if ($errors->has('address_neighborhood'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address_neighborhood') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" class="form-control @error('address_city') is-invalid @enderror" id="address_city" name="address_city" placeholder="Cidade" value="{{old('address_city', $client->address_city)}}" autocomplete="off">
                                        @if ($errors->has('address_city'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address_city') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" class="form-control @error('address_state') is-invalid @enderror" id="address_state" name="address_state" placeholder="Estado" value="{{old('address_state', $client->address_state)}}" autocomplete="off">
                                        @if ($errors->has('address_state'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address_state') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>CEP</label>
                                        <input type="text" class="form-control @error('address_cep') is-invalid @enderror" id="address_cep" name="address_cep" placeholder="CEP" value="{{old('address_cep', $client->address_cep)}}" autocomplete="off">
                                        @if ($errors->has('address_cep'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address_cep') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <a href="{{route('cms.client.index')}}" class="btn btn-default float-right">Cancelar</a>
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
    console.log('1234231');
    $(document).ready(function() {
        $('#cpf').mask('000.000.000-00', {
            reverse: true
        });
        $('#phone').mask('(00) 00000-0000');
        $('#net_income').maskMoney({
            prefix: 'R$ ', // Prefixo
            thousands: '.', // Separador de milhares
            decimal: ',', // Separador decimal
            allowZero: true // Permite valor zero
        });
        $('#gross_income').maskMoney({
            prefix: 'R$ ', // Prefixo
            thousands: '.', // Separador de milhares
            decimal: ',', // Separador decimal
            allowZero: true // Permite valor zero
        });
    });
</script>
@endsection