@extends('back.layouts.principal')

@section('title', 'Candidatures rejetées')
@section('page_title', 'Candidatures rejetées')
@section('page_subtitle', 'Historique des profils écartés du processus de recrutement.')

@section('content')
    @include('back.rh.candidatures._table-status', [
        'pageTitleInner' => 'Profils rejetés',
        'description' => 'Toutes les candidatures rejetées.',
        'candidaturesList' => $candidatures
    ])
@endsection