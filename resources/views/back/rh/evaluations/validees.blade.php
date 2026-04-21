@extends('back.layouts.principal')

@section('title', 'Évaluations validées')
@section('page_title', 'Évaluations validées')
@section('page_subtitle', 'Toutes les évaluations finalisées et validées dans le cycle RH.')

@section('content')
    @include('back.rh.evaluations._table-status', [
        'pageTitleInner' => 'Évaluations validées',
        'description' => 'Toutes les évaluations officiellement validées.',
        'evaluationsList' => $evaluations
    ])
@endsection