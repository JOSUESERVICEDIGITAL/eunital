@extends('back.layouts.principal')
@section('title', 'Applications mobiles')
@section('page_title', 'Chambre développement · Applications mobiles')
@section('page_subtitle', 'Suivi des applications Android, iOS, hybrides et PWA du hub.')
@section('content')
    <div class="row g-4">
        <div class="col-12">
            @include('back.chambre-developpement.applications-mobiles._liste-statut', [
                'applications' => $applications,
                'titreBloc' => 'Applications mobiles',
                'descriptionBloc' => 'Vue centrale des projets mobiles.'
            ])
        </div>
    </div>
@endsection
