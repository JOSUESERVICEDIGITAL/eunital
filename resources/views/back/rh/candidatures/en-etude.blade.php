@extends('back.layouts.principal')

@section('title', 'Candidatures en étude')
@section('page_title', 'Candidatures en étude')
@section('page_subtitle', 'Profils en cours d’analyse, à qualifier ou à préparer pour la prochaine étape.')

@section('content')
    @include('back.rh.candidatures._table-status', [
        'pageTitleInner' => 'Profils en étude',
        'description' => 'Candidatures reçues et actuellement analysées.',
        'candidaturesList' => $candidatures
    ])
@endsection