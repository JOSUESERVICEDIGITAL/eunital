@extends('back.layouts.principal')

@section('title', 'Candidatures en entretien')
@section('page_title', 'Candidatures en entretien')
@section('page_subtitle', 'Profils passés au stade entretien et à suivre de près dans le pipeline.')

@section('content')
    @include('back.rh.candidatures._table-status', [
        'pageTitleInner' => 'Profils en entretien',
        'description' => 'Toutes les candidatures actuellement au stade entretien.',
        'candidaturesList' => $candidatures
    ])
@endsection