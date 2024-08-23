@extends('layouts.web')
@section('title', 'Inspeção')
@section('body')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-primary">
                    <form method="GET" action="{{route('web.inspection.create')}}">
                        @method('GET')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <img src="../storage/static/logo_overhaul.jpeg" style="width:70%;" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4><label>Checklist de Inspeção</label></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5><label>Checklist Inicial</label></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>
                                                IMPORTANTE: Certifique-se de que todos os dados deste Checklist estão de acordo. Somente assim poderá prosseguir.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck1 @error('customCheck1') is-invalid @enderror" name="customCheck1" id="customCheck1">
                                                <label class="custom-control-label font-weight-normal" for="customCheck1">O Bloqueio do equipamento foi realizado de forma correta?</label>
                                            </div>
                                            @if ($errors->has('customCheck1'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck1') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck2 @error('customCheck2') is-invalid @enderror" name="customCheck2" id="customCheck2">
                                                <label class="custom-control-label font-weight-normal" for="customCheck2">A área de trabalho apresenta condições seguras para continuação das atividades?</label>
                                            </div>
                                            @if ($errors->has('customCheck2'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck2') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck3 @error('customCheck3') is-invalid @enderror" name="customCheck3" id="customCheck3">
                                                <label class="custom-control-label font-weight-normal" for="customCheck3">O local de trabalho está devidamente isolado?</label>
                                            </div>
                                            @if ($errors->has('customCheck3'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck3') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck4 @error('customCheck4') is-invalid @enderror" name="customCheck4" id="customCheck4">
                                                <label class="custom-control-label font-weight-normal" for="customCheck4">Todos os colaboradores estão usando EPI’s corretamente?</label>
                                            </div>
                                            @if ($errors->has('customCheck4'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck4') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck5 @error('customCheck5') is-invalid @enderror" name="customCheck5" id="customCheck5">
                                                <label class="custom-control-label font-weight-normal" for="customCheck5">Todos os colaboradores estão aptos a realização das atividades e com os treinamentos em dias?</label>
                                            </div>
                                            @if ($errors->has('customCheck5'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck5') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck6 @error('customCheck6') is-invalid @enderror" name="customCheck6" id="customCheck6">
                                                <label class="custom-control-label font-weight-normal" for="customCheck6">Todas as ferramentas e equipamentos estão devidamente inspecionados e fora da cor proibida do mês?</label>
                                            </div>
                                            @if ($errors->has('customCheck6'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck6') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck7 @error('customCheck7') is-invalid @enderror" name="customCheck7" id="customCheck7">
                                                <label class="custom-control-label font-weight-normal" for="customCheck7">Produtos químicos utilizados estão homologados?</label>
                                            </div>
                                            @if ($errors->has('customCheck7'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck7') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck8 @error('customCheck8') is-invalid @enderror" name="customCheck8" id="customCheck8">
                                                <label class="custom-control-label font-weight-normal" for="customCheck8">As documentações de segurança estão preenchidas de forma correta e disponíveis no local de trabalho?</label>
                                            </div>
                                            @if ($errors->has('customCheck8'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck8') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck9 @error('customCheck9') is-invalid @enderror" name="customCheck9" id="customCheck9">
                                                <label class="custom-control-label font-weight-normal" for="customCheck9">APR encontra liberada e ou inspecionada pela fiscalização conforme os riscos da tarefa?</label>
                                            </div>
                                            @if ($errors->has('customCheck9'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck9') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck10 @error('customCheck10') is-invalid @enderror" name="customCheck10" id="customCheck10">
                                                <label class="custom-control-label font-weight-normal" for="customCheck10">CTodos os funcionários possuem as devidas permissões para continuação da atividade?</label>
                                            </div>
                                            @if ($errors->has('customCheck10'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck10') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input customCheck11 @error('customCheck11') is-invalid @enderror" name="customCheck11" id="customCheck11">
                                                <label class="custom-control-label font-weight-normal" for="customCheck11">Comunicação de emergência está funcionando?</label>
                                            </div>
                                            @if ($errors->has('customCheck11'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('customCheck11') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="display:flex; justify-content:end; background-color: transparent;">
                            <label for="">&nbsp</label>
                            <button type="submit" style="width: 15%;" class="btn btn-primary btn-sm active" id="save_button"> Prosseguir para Checklist</button>
                            <label for="">&nbsp&nbsp</label>
                            <a href="{{route('web.inspection.create')}}" style="width: 8%;" class="btn btn-danger btn-sm active" id="clear_data">Sair</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop