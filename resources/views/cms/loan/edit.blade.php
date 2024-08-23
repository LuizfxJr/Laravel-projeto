@extends('layouts.cms')
@section('title', 'Empréstimos')
@section('content_header')
<div class="row">
    <div class="col-auto">
        <a href="{{route('cms.loan.index')}}" class="btn btn-default">Voltar</a>
    </div>
    <div class="col-auto">
        <h1><i class="fas fa-solid fa-toolbox">&nbsp;</i>Empréstimos</h1>
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
                        <h3 class="card-title ">Atualização de Empréstimo</h3>
                    </div>
                    <form method="POST" action="{{route('cms.loan.update', $client->id)}}" enctype="multipart/form-data">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            <div class="row" style="border: 1px solid black;">
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
                                        <label>Cliente</label>
                                        <br />
                                        <p>{{$client->name}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <br />
                                        <p>{{$client->email}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <br />
                                        <p>{{$client->phone}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <br />
                                        <p>{{$client->cpf}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>RG</label>
                                        <br />
                                        <p>{{$client->rg}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border: 1px solid black;">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Data Expedição</label>
                                        <br />
                                        <p>{{Carbon\Carbon::parse($client->shipping_date)->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Orgão Expedidor</label>
                                        <br />
                                        <p>{{$client->issuing_agency}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Data Nascimento</label>
                                        <br />
                                        <p>{{Carbon\Carbon::parse($client->birth_date)->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <br />
                                        <p>{{$client->marital_status}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Nome da Mãe</label>
                                        <br />
                                        <p>{{$client->mother_name}}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="border: 1px solid black;">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <br />
                                        <p>{{$client->company}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Regime de Trabalho</label>
                                        <br />
                                        <p>{{$client->work_regime}}</p>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Profissão</label>
                                        <br />
                                        <p>{{$client->profession}}</p>
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Salário Bruto</label>
                                        <br />
                                        <p>{{$client->gross_income}}</p>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Salário Liquido</label>
                                        <br />
                                        <p>{{$client->profession}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border: 1px solid black;">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <br />
                                        <p>{{$client->address}}</p>
                                    </div>
                                </div>


                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label>N°</label>
                                        <br />
                                        <p>{{$client->address_number}}</p>
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <br />
                                        <p>{{$client->address_neighborhood}}</p>
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <br />
                                        <p>{{$client->address_city}}</p>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <br />
                                        <p>{{$client->address_state}}</p>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>CEP</label>
                                        <br />
                                        <p>{{$client->address_cep}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="border: 1px solid black; padding-top: 10px;">
                                <div class="col-3">
                                    @if ($loans->file_cpf_url)
                                    <a href="{{ $loans->file_cpf_url }}" class="btn btn-xs btn-primary" target="download">
                                        <i class="fas fa-download"></i> Download CPF</a>
                                    @else
                                    <p>Sem CPF</p>
                                    @endif
                                </div>
                                <div class="col-3">
                                    @if ($loans->file_rg_url)
                                    <a href="{{ $loans->file_rg_url }}" class="btn btn-xs btn-primary" target="download">
                                        <i class="fas fa-download"></i> Download RG</a>
                                    @else
                                    <p>Sem RG</p>
                                    @endif
                                </div>
                                <div class="col-3">
                                    @if ($loans->file_ir_url)
                                    <a href="{{ $loans->file_cc_url }}" class="btn btn-xs btn-primary" target="download">
                                        <i class="fas fa-download"></i> Download Comprovante Residencia</a>
                                    @else
                                    <p>Sem Comprovante</p>
                                    @endif
                                </div>
                                <div class="col-3">
                                    @if ($loans->file_cc_url)
                                    <a href="{{ $loans->file_ir_url }}" class="btn btn-xs btn-primary" target="download">
                                        <i class="fas fa-download"></i> Download Contra Cheque</a>
                                    @else
                                    <p>Sem IR</p>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Status*</label>
                                        <select name="status" id="status" class="form-control  @error('status') is-invalid @enderror">
                                            <option value="">Status</option>
                                            @foreach($status as $item)
                                            <option value="{{$item}}" {{$item==(old('status') ? old('status') : $loans->status) ? 'selected' : ''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Tipo de Consignado*</label>
                                        <input type="text" class="form-control @error('consigned_type') is-invalid @enderror" id="consigned_type" name="consigned_type" placeholder="Tipo de Consignado" value="{{old('consigned_type', $loans->consigned_type)}}" autocomplete="off">
                                        @if ($errors->has('consigned_type'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('consigned_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Valor Beneficio/Renda*</label>
                                        <input type="text" class="form-control @error('consigned_value') is-invalid @enderror" id="consigned_value" name="consigned_value" placeholder="Valor Beneficio/Renda" value="{{old('consigned_value', $loans->consigned_value)}}" autocomplete="off">
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
                                        <input type="text" class="form-control @error('kind_benefit') is-invalid @enderror" id="kind_benefit" name="kind_benefit" placeholder="Espécie do Beneficio" value="{{old('kind_benefit', $loans->kind_benefit)}}" autocomplete="off">
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
                                        <input type="text" class="form-control @error('registration') is-invalid @enderror" id="registration" name="registration" placeholder="N° Beneficio/Matricula" value="{{old('registration', $loans->registration)}}" autocomplete="off">
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
                                        <input type="text" class="form-control @error('margin') is-invalid @enderror" id="margin" name="margin" placeholder="Entrada" value="{{old('margin', $loans->margin)}}" autocomplete="off">
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
                                        <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank" name="bank" placeholder="Banco" value="{{old('bank', $loans->bank)}}" autocomplete="off">
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
                                        <input type="text" class="form-control @error('agency') is-invalid @enderror" id="agency" name="agency" placeholder="Agência" value="{{old('agency', $loans->agency)}}" autocomplete="off">
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
                                        <input type="text" class="form-control @error('account') is-invalid @enderror" id="account" name="account" placeholder="Conta" value="{{old('account', $loans->account)}}" autocomplete="off">
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
                                            <option value="{{$item}}" {{$item==(old('type_account') ? old('type_account') : $loans->type_account) ? 'selected' : ''}}>{{$item}}</option>
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

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Conclusão</label>
                                        <textarea type="text" class="form-control @error('conclusion') is-invalid @enderror" id="conclusion" name="conclusion" placeholder="Conclusão" value="{{old('conclusion', $loans->conclusion)}}" autocomplete="off" rows="3"></textarea>
                                        @if ($errors->has('conclusion'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('conclusion') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea type="text" class="form-control @error('observation') is-invalid @enderror" id="observation" name="observation" placeholder="Observações" value="{{old('observation', $loans->observation)}}" autocomplete="off" rows="3"></textarea>
                                        @if ($errors->has('observation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('observation') }}</strong>
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
                                        <input type="file" class="form-control @error('file_cpf') is-invalid @enderror custom-file-input" id="file_cpf" name="file_cpf">
                                        <label class="custom-file-label" for="customFile">CPF</label>
                                        @if ($errors->has('file_cpf'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('file_cpf') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('file_rg') is-invalid @enderror custom-file-input" id="file_rg" name="file_rg">
                                        <label class="custom-file-label" for="customFile">RG</label>
                                        @if ($errors->has('file_rg'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('file_rg') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('file_cr') is-invalid @enderror custom-file-input" id="file_cr" name="file_cr">
                                        <label class="custom-file-label" for="customFile">Comprovante de Residencia</label>
                                        @if ($errors->has('file_cr'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('file_cr') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" style="margin-left: 5px !important;">
                                    <div class="form-group">
                                        <input type="file" class="form-control @error('file_ir') is-invalid @enderror custom-file-input" id="file_ir" name="file_ir">
                                        <label class="custom-file-label" for="customFile">Contra Cheque</label>
                                        @if ($errors->has('file_ir'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('file_ir') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
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