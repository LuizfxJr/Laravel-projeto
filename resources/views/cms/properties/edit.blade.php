@extends('layouts.cms')
@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-search">Editar Imóvel</h2>

        <div class="dash_content_app_header_actions">

            <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
        </div>
    </header>

    <div class="dash_content_app_box">

        <div class="nav">
            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#structure" class="nav_tabs_item_link">Estrutura</a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#images" class="nav_tabs_item_link">Imagens</a>
                </li>
            </ul>

            <form action="{{ route('cms.properties.update', $property->id) }}" method="post" class="app_form" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="nav_tabs_content">
                    <div id="data">
                        <div class="label_gc">
                            <span class="legend">Finalidade:</span>
                            <label class="label">
                                <input type="checkbox" name="sale" {{ (!!old('sale', $property->sale))?'checked':'' }}>
                                <span>Venda</span>
                            </label>
                            <label class="label">
                                <input type="checkbox" name="rent" {{ (!!old('rent', $property->rent))?'checked':'' }}>
                                <span>Locação</span>
                            </label>
                            <label class="label">
                                <input type="checkbox" name="status" {{ (!!old('status', $property->status))?'checked': '' }}>
                                <span>Disponível</span>
                            </label>
                        </div>
                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Categoria:</span>
                                <select name="category" class="select2">
                                    <option>&nbsp;</option>
                                    @foreach($list_category as $key => $category)
                                    <option value="{{ $key }}" {{ old('category', $property->category) == $key?'selected':'' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="label"> <span class="legend">Tipo:</span>
                                <select name="type" class="select2">
                                    <option>&nbsp;</option>
                                    @foreach($list_type as $key => $items)
                                    <optgroup label="{{ $key }}">
                                        @foreach($items as $key => $item)
                                        <option value="{{ $key }}" {{ old('type', $property->type) == $key?'selected':'' }}>{{ $item }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        

                        <div class="label_g2">
                        <label class="label">
                            <span class="legend">Corretor:</span>
                            <select name="user_id" class="select2" disabled>
                                @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (Auth::check() && Auth::user()->id == $user->id) || $user->id == $property->user_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="user_id" value="{{ (Auth::check() && !Gate::check('adm_supervisor')) ? Auth::user()->id : '' }}">
                        </label>


                            <label class="label"> <span class="legend">Status</span>
                                <select name="status" class="select2">
                                    <option value="0" {{ (old('status', $property->status) == 0 ? 'selected' : ('')) }}>Ativo</option>
                                    <option value="1" {{ (old('status', $property->status) == 1 ? 'selected' : ( '')) }}>Vendido</option>
                                </select>
                            </label>
                        </div>


                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Precificação e Valores</h3>
                            </div>

                            <div class="app_collapse_content">
                                <div class="label_g2">
                                    <label class="label"> <span class="legend">Valor de Venda:</span>
                                        <input type="tel" name="sale_price" class="mask-money" value="{{ old('sale_price', $property->sale_price) }}" /> </label>

                                    <label class="label"> <span class="legend">Valor de Locação:</span>
                                        <input type="tel" name="rent_price" class="mask-money" value="{{ old('rent_price', $property->rent_price) }}" /> </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label"> <span class="legend">IPTU:</span>
                                        <input type="tel" name="tribute" class="mask-money" value="{{ old('tribute', $property->tribute) }}" /> </label>

                                    <label class="label"> <span class="legend">Condomínio:</span>
                                        <input type="tel" name="condominium" class="mask-money" value="{{ old('condominium', $property->condominium) }}" /> </label>
                                </div>
                            </div>

                            <label class="label">
                                <span class="legend">Título:</span>
                                <input type="text" name="title" value="{{ old('title', $property->title) ?? '' }}"> </label>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">Experiência</span>
                                    <select name="experience" class="select2">
                                        <option value="Cobertura" {{ (old('experience', $property->experience) == 'Cobertura' ? 'selected' : ('')) }}>Cobertura</option>
                                        <option value="Alto Padrão" {{ (old('experience', $property->experience) == 'Alto Padrão' ? 'selected' : ( '')) }}>Alto Padrão</option>
                                        <option value="De Frente para o Mar" {{ (old('experience', $property->experience) == 'De Frente para o Mar' ? 'selected' : ('')) }}>De Frente para o Mar</option>
                                        <option value="Condomínio Fechado" {{ (old('experience', $property->experience) == 'Condomínio Fechado' ? 'selected' : ('')) }}>Condomínio Fechado</option>
                                        <option value="Compacto" {{ (old('experience', $property->experience) == 'Compacto' ? 'selected' : ('')) }}>Compacto</option>
                                        <option value="Lojas e Salas" {{ (old('experience', $property->experience) == 'Lojas e Salas' ? 'selected' : ('')) }}>Lojas e Salas</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Características</h3>
                            </div>


                            <div class="app_collapse_content">
                                <label class="label"> <span class="legend">Descrição do Imóvel:</span>
                                    <textarea name="description" cols="30" rows="10" class="mce">{{ old('description', $property->description) }}</textarea>
                                </label>

                                <div class="label_g4">
                                    <label class="label"> <span class="legend">Dormitórios:</span>
                                        <input type="text" name="bedrooms" placeholder="Quantidade de Dormitórios" value="{{ old('bedrooms', $property->bedrooms) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Suítes:</span>
                                        <input type="text" name="suites" placeholder="Quantidade de Suítes" value="{{ old('suites', $property->suites) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Banheiros:</span>
                                        <input type="text" name="bathrooms" placeholder="Quantidade de Banheiros" value="{{ old('bathrooms', $property->bathrooms) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Salas:</span>
                                        <input type="text" name="rooms" placeholder="Quantidade de Salas" value="{{ old('rooms', $property->rooms) }}" />
                                    </label>
                                </div>

                                <div class="label_g4">
                                    <label class="label"> <span class="legend">Garagem:</span>
                                        <input type="text" name="garage" placeholder="Quantidade de Garagem" value="{{ old('garage', $property->garage) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Garagem Coberta:</span>
                                        <input type="text" name="garage_covered" placeholder="Quantidade de Garagem Coberta" value="{{ old('garage_covered', $property->garage_covered) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Área Total:</span>
                                        <input type="text" name="area_total" placeholder="Quantidade de M&sup2;" value="{{ old('area_total', $property->area_total) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Área Útil:</span>
                                        <input type="text" name="area_util" placeholder="Quantidade de M&sup2;" value="{{ old('area_util', $property->area_util) }}" />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Endereço</h3>
                            </div>

                            <div class="app_collapse_content">


                                <label class="label"> <span class="legend">Endereço:</span>
                                    <input type="text" name="street" class="street" placeholder="Endereço Completo" value="{{ old('street', $property->street) }}" />
                                </label>

                                <div class="label_g2">
                                    <label class="label"> <span class="legend">Número:</span>
                                        <input type="text" name="number" placeholder="Número do Endereço" value="{{ old('number', $property->number) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Complemento:</span>
                                        <input type="text" name="complement" placeholder="Completo (Opcional)" value="{{ old('complement', $property->complement) }}" />
                                    </label>
                                </div>

                                <label class="label"> <span class="legend">Bairro:</span>
                                    <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro" value="{{ old('neighborhood', $property->neighborhood) }}" />
                                </label>

                                <div class="label_g2">
                                    <label class="label"> <span class="legend">Estado:</span>
                                        <input type="text" name="state" class="state" placeholder="Estado" value="{{ old('state', $property->state) }}" />
                                    </label>

                                    <label class="label"> <span class="legend">Cidade:</span>
                                        <input type="text" name="city" class="city" placeholder="Cidade" value="{{ old('city', $property->city) }}" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="structure">
                        <h3 class="mb-2">Estrutura</h3>
                        <div class="label_g5">
                            <div>
                                <label class="label">
                                    <input type="checkbox" name="air_conditioning" {{ (!!old('air_conditioning', $property->air_conditioning))?'checked':'' }}><span>Ar Condicionado</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="bar" {{ (!!old('bar', $property->bar))?'checked':'' }}><span>Bar</span> </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="library" {{ (!!old('library', $property->library))?'checked':'' }}><span>Biblioteca</span>
                                </label>
                            </div>

                            <div>
                                <label class="label">
                                    <input type="checkbox" name="barbecue_grill" {{ (!!old('barbecue_grill', $property->barbecue_grill))?'checked':'' }}><span>Churrasqueira</span> </label>
                            </div>

                            <div>
                                <label class="label">
                                    <input type="checkbox" name="american_kitchen" {{ (!!old('american_kitchen', $property->american_kitchen))?'checked':'' }}><span>Cozinha Americana</span>
                                </label>
                            </div>

                            <div>
                                <label class="label">
                                    <input type="checkbox" name="fitted_kitchen" {{ (!!old('fitted_kitchen', $property->fitted_kitchen))?'checked':'' }}><span>Cozinha Planejada</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="pantry" {{ (!!old('pantry', $property->pantry))?'checked':'' }}><span>Despensa</span>
                                </label>
                            </div>

                            <div>
                                <label class="label"> <input type="checkbox" name="edicule" {{ (!!old('edicule', $property->edicule))?'checked':'' }}><span>Edícula</span>
                                </label>
                            </div>

                            <div>
                                <label class="label"> <input type="checkbox" name="office" {{ (!!old('office', $property->office))?'checked':'' }}><span>Escritório</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="bathtub" {{ (!!old('bathtub', $property->bathtub))?'checked':'' }}><span>Banheira</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="fireplace" {{ (!!old('fireplace', $property->fireplace))?'checked':'' }}><span>Lareira</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="lavatory" {{ (!!old('lavatory', $property->lavatory))?'checked':'' }}><span>Lavabo</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="furnished" {{ (!!old('furnished', $property->furnished))?'checked':'' }}><span>Mobiliado</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="pool" {{ (!!old('pool', $property->pool))?'checked':'' }}><span>Piscina</span>
                                </label>
                            </div>
                            <div>
                                <label class="label"> <input type="checkbox" name="steam_room" {{ (!!old('steam_room', $property->steam_room))?'checked':'' }}><span>Sauna</span>
                                </label>
                            </div>
                            <div>
                                <label class="label">
                                    <input type="checkbox" name="view_of_the_sea" {{ (!!old('view_of_the_sea', $property->view_of_the_sea))?'checked':'' }}><span>Vista para o Mar</span>
                                </label>
                            </div>
                        </div>
                        <h3 class="mt-2 mb-1">Informações do Site</h3>


                    </div>

                    <div class="row">
                        @foreach ($property->images as $item)
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="{{ $item->image_url }}" class="img-thumbnail" style="height: 150px;" alt="">
                                <br><br>

                                <div class="file-actions">
                                    <a href="{{ $item->image_url }}"><i class="fa fa-download"></i></a>
                                    <a href="{{ $item->image_url }}" onclick="return confirm('Want to remove this file?');"><i class="fa fa-trash" style="color: red;"></i></a> <!-- Ícone de delete -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="images">
                        <label class="label"> <span class="legend">Imagens</span>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image[]" multiple='multiple'> </label>

                        <div class="content_image"></div>
                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o">Criar Imóvel</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('js_block')
<script>
    $(function() {
        $('input[name="files[]"]').change(function(files) {

            $('.content_image').text('');

            $.each(files.target.files, function(key, value) {
                let reader = new FileReader();
                reader.onload = function(value) {
                    $('.content_image').append(
                        `<div class="property_image_item">
                                <div class="embed radius" style="background-image: url(${value.target.result}); background-size: cover; background-position: center center;">
                                </div>
                            </div>`
                    );
                };
                reader.readAsDataURL(value);
            });
        });
    });
</script>
@endsection