@extends('back.layouts.principal')

@section('title', 'Candidatures retenues')
@section('page_title', 'Candidatures retenues')
@section('page_subtitle', 'Profils sélectionnés et retenus dans le cadre des campagnes de recrutement.')

@section('content')
    @include('back.rh.candidatures._table-status', [
        'pageTitleInner' => 'Profils retenus',
        'description' => 'Toutes les candidatures retenues.',
        'candidaturesList' => $candidatures
    ])
@endsection