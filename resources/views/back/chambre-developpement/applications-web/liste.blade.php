@extends('back.layouts.principal')

@section('title', 'Applications web')
@section('page_title', 'Chambre développement · Applications web')
@section('page_subtitle', 'Pilotage des plateformes web, dashboards, backoffices et systèmes applicatifs du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">Production web</h4>
                        <p class="text-muted mb-0">Vue centrale des applications web du hub.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.chambre-developpement.applications-web.toutes') }}" class="btn btn-outline-dark rounded-pill px-4">Toutes</a>
                        <a href="{{ route('back.chambre-developpement.applications-web.conception') }}" class="btn btn-outline-secondary rounded-pill px-4">Conception</a>
                        <a href="{{ route('back.chambre-developpement.applications-web.developpement') }}" class="btn btn-outline-primary rounded-pill px-4">Développement</a>
                        <a href="{{ route('back.chambre-developpement.applications-web.tests') }}" class="btn btn-outline-info rounded-pill px-4">Tests</a>
                        <a href="{{ route('back.chambre-developpement.applications-web.en_ligne') }}" class="btn btn-outline-success rounded-pill px-4">En ligne</a>
                        <a href="{{ route('back.chambre-developpement.applications-web.critiques') }}" class="btn btn-outline-danger rounded-pill px-4">Critiques</a>
                        <a href="{{ route('back.chambre-developpement.applications-web.creer') }}" class="btn btn-primary rounded-pill px-4">Nouvelle application</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.chambre-developpement.applications-web._liste-statut', [
                'applications' => $applications,
                'titreBloc' => 'Applications web',
                'descriptionBloc' => 'Suivi global des applications web.'
            ])
        </div>
    </div>
@endsection
