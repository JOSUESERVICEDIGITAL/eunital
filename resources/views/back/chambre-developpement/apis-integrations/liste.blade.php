@extends('back.layouts.principal')

@section('title', 'API & intégrations')
@section('page_title', 'Chambre développement · API & intégrations')
@section('page_subtitle', 'Gestion des services REST, GraphQL, webhooks, SDK et connecteurs du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            @include('back.chambre-developpement.apis-integrations._liste-statut', [
                'apis' => $apis,
                'titreBloc' => 'API & intégrations',
                'descriptionBloc' => 'Vue centrale des services d’intégration et des connecteurs techniques.'
            ])
        </div>
    </div>
@endsection
