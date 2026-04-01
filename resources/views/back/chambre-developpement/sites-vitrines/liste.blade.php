@extends('back.layouts.principal')

@section('title', 'Sites vitrines')
@section('page_title', 'Chambre développement · Sites vitrines')
@section('page_subtitle', 'Gestion des sites institutionnels, landing pages, vitrines commerciales et pages de présentation du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            @include('back.chambre-developpement.sites-vitrines._liste-statut', [
                'sites' => $sites,
                'titreBloc' => 'Sites vitrines',
                'descriptionBloc' => 'Vue centrale de tous les sites vitrines du hub.'
            ])
        </div>
    </div>
@endsection
