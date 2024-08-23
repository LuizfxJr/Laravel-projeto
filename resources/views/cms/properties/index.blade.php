@extends('layouts.cms')
@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-search">Filtro</h2>

        <div class="dash_content_app_header_actions">
            <a href="{{ route('cms.properties.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Criar Imóvel</a>
        </div>
    </header>

    <br />

    <form>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <input name="search" placeholder="Buscar por título" class="form-control" value="">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="" selected>Todos</option>
                        <option value="0">Ativo</option>
                        <option value="1">Vendido</option>
                    </select>
                </div>
            </div>

            <div class="col-auto">
                <div class="form-group">
                    <button id="consultar" type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search-plus"></i> Consultar
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="dash_content_app_box">
        <div class="dash_content_app_box_stage">
            <div class="realty_list">
                @if (!!count($properties))
                @foreach($properties as $item)

                <div class="realty_list_item mb-1">
                    <div class="realty_list_item_actions_stats">

                        <a href="{{ route('cms.properties.view', $item->id) }}" class="btn btn-primary btn-sm">
                            @if(count($item->images) > 0)
                            <img src="{{ $item->images[0]->image_url }}" class="d-block w-100" alt="...">
                            @else
                            <img src="{{ asset('storage/properties/image-default.jpg') }}" class="d-block w-100" alt="...">
                            @endif
                        </a>

                        <ul>
                            @if (!!$item->sale && !!$item->sale_price)
                            <li>Venda: R$ {{ $item->sale_price }}</li>
                            @endif
                            @if (!!$item->rent && !!$item->rent_price)
                            <li>Aluguel: R$ {{$item->rent_price }}</li>
                            @endif

                        </ul>
                    </div>
                    <div class="realty_list_item_content">
                        <h4>{{ $list_category[$item->category] }} - {{ $list_type_simple[$item->type] }} - {{ $item->status == 1 ? 'VENDIDO' : 'ATIVO' }}</h4>

                        <div class="realty_list_item_card">
                            <div class="realty_list_item_card_image">
                                <span class="icon-realty-location"></span>
                            </div>
                            <div class="realty_list_item_card_content">
                                <span class="realty_list_item_description_title">Bairro:</span>
                                <span class="realty_list_item_description_content">{{ $item->neighborhood }}</span>
                            </div>
                        </div>

                        <div class="realty_list_item_card">
                            <div class="realty_list_item_card_image">
                                <span class="icon-realty-util-area"></span>
                            </div>
                            <div class="realty_list_item_card_content">
                                <span class="realty_list_item_description_title">Área Útil:</span>
                                <span class="realty_list_item_description_content">{{ $item->area_util }}m&sup2;</span>
                            </div>
                        </div>

                        <div class="realty_list_item_card">
                            <div class="realty_list_item_card_image">
                                <span class="icon-realty-bed"></span>
                            </div>
                            <div class="realty_list_item_card_content">
                                <span class="realty_list_item_description_title">Dormitórios:</span>
                                <span class="realty_list_item_description_content">{{ $item->bedrooms }} Quartos<br>
                                    @if (!!$item->suites)
                                    <span>Sendo {{ $item->suites }} suítes</span></span>
                                @endif
                            </div>
                        </div>

                        <div class="realty_list_item_card">
                            <div class="realty_list_item_card_image">
                                <span class="icon-realty-garage"></span>
                            </div>
                            <div class="realty_list_item_card_content">
                                <span class="realty_list_item_description_title">Garagem:</span>
                                <span class="realty_list_item_description_content">{{ $item->garage }} Vagas<br>
                                    @if(!!$item->garage_covered)
                                    <span>Sendo {{ $item->garage_covered }} cobertas</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="realty_list_item_actions">
                        <div>
                            <a href="{{ route('cms.properties.edit',['property'=> $item->id]) }}" class="btn btn-green icon-pencil-square-o">Editar Imóvel</a>
                        </div>
                    </div>
                </div>

                @endforeach
                @else
                <div class="no-content">Não foram encontrados registros!</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection