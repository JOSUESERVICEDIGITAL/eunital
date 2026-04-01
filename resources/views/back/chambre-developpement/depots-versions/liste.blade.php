@extends('back.layouts.principal')

@section('title', 'Dépôts et versions')
@section('page_title', 'Chambre développement · Dépôts et versions')
@section('page_subtitle', 'Gestion des dépôts Git, branches, versions, releases, hotfix et états de déploiement du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            @include('back.chambre-developpement.depots-versions._liste-statut', [
                'depots' => $depots,
                'titreBloc' => 'Dépôts et versions',
                'descriptionBloc' => 'Vue centrale des dépôts, branches principales et états de livraison.'
            ])
        </div>
    </div>
@endsection
