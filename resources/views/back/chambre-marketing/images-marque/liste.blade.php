@extends('back.layouts.principal')

@section('title', 'Image de marque')
@section('page_title', 'Chambre marketing · Image de marque')
@section('page_subtitle', 'Gestion du slogan, du ton, de la charte, du logo et de l’identité visuelle du hub.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Pilotage de l’image de marque</h4>
                        <p class="text-muted mb-0">Structure le ton, la cohérence visuelle, la ligne éditoriale et les éléments symboliques de la marque.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-marketing.images-marque.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">
                            Toutes
                        </a>

                        <a href="{{ route('back.chambre-marketing.images-marque.actives') }}" class="btn btn-outline-success rounded-pill px-4">
                            Actives
                        </a>

                        <a href="{{ route('back.chambre-marketing.images-marque.obsoletes') }}" class="btn btn-outline-warning rounded-pill px-4">
                            Obsolètes
                        </a>

                        <a href="{{ route('back.chambre-marketing.images-marque.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-1"></i> Nouvelle image
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-marketing.images-marque._table', [
                'imagesMarque' => $imagesMarque,
                'titreBloc' => 'Toutes les images de marque',
                'descriptionBloc' => 'Vue globale des identités de marque, slogans, chartes et lignes éditoriales.'
            ])
        </div>

    </div>
@endsection