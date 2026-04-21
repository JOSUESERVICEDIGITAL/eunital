@extends('back.layouts.principal')

@section('title', 'Absences')
@section('page_title', 'Absences')
@section('page_subtitle', 'Vue ciblée des absences pour un suivi RH rapide et une meilleure visibilité managériale.')

@section('content')
    @include('back.rh.presences._table-list', [
        'pageTitleInner' => 'Liste des absences',
        'description' => 'Tous les enregistrements marqués en absence.',
        'presencesList' => $presences
    ])
@endsection