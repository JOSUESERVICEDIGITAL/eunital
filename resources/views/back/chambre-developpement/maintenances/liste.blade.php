@extends('back.layouts.principal')

@section('title', 'Maintenances')
@section('page_title', 'Chambre développement · Maintenances')
@section('page_subtitle', 'Suivi des incidents, corrections, évolutions, urgences et opérations de maintenance technique.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            @include('back.chambre-developpement.maintenances._liste-statut', [
                'maintenances' => $maintenances,
                'titreBloc' => 'Maintenances techniques',
                'descriptionBloc' => 'Vue centrale des interventions techniques et des opérations de maintenance.'
            ])
        </div>
    </div>
@endsection
