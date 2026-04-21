@extends('back.layouts.principal')

@section('title', 'Retards')
@section('page_title', 'Retards')
@section('page_subtitle', 'Vue ciblée des retards pour identifier les récurrences et faciliter les actions RH.')

@section('content')
    @include('back.rh.presences._table-list', [
        'pageTitleInner' => 'Liste des retards',
        'description' => 'Tous les enregistrements marqués en retard.',
        'presencesList' => $presences
    ])
@endsection