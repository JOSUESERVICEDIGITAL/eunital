@extends('back.layouts.principal')

@section('title', 'Évaluations archivées')
@section('page_title', 'Évaluations archivées')
@section('page_subtitle', 'Historique archivé des évaluations RH pour consultation et traçabilité.')

@section('content')
    @include('back.rh.evaluations._table-status', [
        'pageTitleInner' => 'Évaluations archivées',
        'description' => 'Toutes les évaluations archivées.',
        'evaluationsList' => $evaluations
    ])
@endsection