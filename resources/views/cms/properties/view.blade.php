@extends('layouts.cms')
@section('content')
<section class="dash_content_app">

    <div class="main_property">
        <div class="main_property_header bg-light" style="margin: 6rem 0 2rem 0;">
            <div class="container" style="padding: 1rem 0 1rem 0;">
                <h1 class="text-front font-weight-bold">{{ $property->title }}</h1>
                <p class="mb-0">{{ $property->type_text }} - {{ $property->neighborhood }}</p>
            </div>
        </div>
        <div class="main_property_content">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            @if(count($property->images) > 0)
                            <div class="carousel-inner">
                                @foreach ($property->images as $item)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ $item->image_url }}" class="d-block w-100" alt="...">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/properties/image-default.jpg') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            @endif

                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span> </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span> </a>
                        </div>
                        <div class="main_property_content_price text-muted">
                            <p class="small">IPTU: R$ {{ $property->tribute ?? '0,00' }} | Condomínio: R$
                                {{ $property->condominium ?? '0,00' }}
                            </p>

                            <p class="text-muted font-weight-bold">Valor do imóvel:
                                {{ $property->sale_price ? 'R$ ' . $property->sale_price : '' }}{{ session('trade') === 'rent' ? (!!$property->sale_price ? '/mês' : 'Entre em contato com suporte') : '' }}
                            </p>

                        </div>
                        <br />
                        <br />
                        <div class="main_property_content_features">
                            <h2 class="text-front font-weight-bold">Características</h2>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Experiência</td>
                                        <td>{{ $property->experience }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dormitórios</td>
                                        <td>{{ $property->bedrooms }}</td>
                                    </tr>
                                    <tr>
                                        <td>Banheiros</td>
                                        <td>{{ $property->bathrooms }}</td>
                                    </tr>
                                    <tr>
                                        <td>Suítes</td>
                                        <td>{{ $property->suites }}</td>
                                    </tr>
                                    <tr>
                                        <td>Salas</td>
                                        <td>{{ $property->rooms }}</td>
                                    </tr>
                                    <tr>
                                        <td>Garagem</td>
                                        <td>{{ $property->garage }}</td>
                                    </tr>
                                    <tr>
                                        <td>Garagem Coberta</td>
                                        <td>{{ $property->garage_covered }}</td>
                                    </tr>
                                    <tr>
                                        <td>Área Total</td>
                                        <td>{{ $property->area_total }} m²</td>
                                    </tr>
                                    <tr>
                                        <td>Área ùtil</td>
                                        <td>{{ $property->area_util }} m²</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="main_property_content_structure pt-5">
                            <h2 class="text-front font-weight-bold">Estrutura</h2>
                            <div class="row">
                                @if ($property->air_conditioning == true)
                                <span class="btn btn-success">Ar Condicionado</span>
                                @endif

                                @if ($property->bar == true)
                                <span class="btn btn-success">Bar</span>
                                @endif

                                @if ($property->library == true)
                                <span class="btn btn-success">Biblioteca</span>
                                @endif

                                @if ($property->barbecue_grill == true)
                                <span class="btn btn-success">Churrasqueira</span>
                                @endif

                                @if ($property->american_kitchen == true)
                                <span class="btn btn-success">Cozinha Americana</span>
                                @endif

                                @if ($property->fitted_kitchen == true)
                                <span class="btn btn-success">Cozinha Planejada</span>
                                @endif

                                @if ($property->pantry == true)
                                <span class="btn btn-success">Despensa</span>
                                @endif

                                @if ($property->edicule == true)
                                <span class="btn btn-success">Edicula</span>
                                @endif

                                @if ($property->office == true)
                                <span class="btn btn-success">Escritório</span>
                                @endif

                                @if ($property->bathtub == true)
                                <span class="btn btn-success">Banheira</span>
                                @endif

                                @if ($property->fireplace == true)
                                <span class="btn btn-success">Lareira</span>
                                @endif

                                @if ($property->lavatory == true)
                                <span class="btn btn-success">Lavabo</span>
                                @endif

                                @if ($property->furnished == true)
                                <span class="btn btn-success">Mobiliado</span>
                                @endif

                                @if ($property->pool == true)
                                <span class="btn btn-success">Piscina</span>
                                @endif

                                @if ($property->steam_room == true)
                                <span class="btn btn-success">Sauna</span>
                                @endif

                                @if ($property->view_of_the_sea == true)
                                <span class="btn btn-success">Vista para o Mar</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection