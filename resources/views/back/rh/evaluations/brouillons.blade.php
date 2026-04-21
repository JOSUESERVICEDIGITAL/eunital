@extends('back.layouts.principal')

@section('title', 'Évaluations en brouillon')
@section('page_title', 'Évaluations en brouillon')
@section('page_subtitle', 'Évaluations à finaliser avant validation RH.')

@section('content')
    @include('back.rh.evaluations._table-status', [
        'pageTitleInner' => 'Évaluations en brouillon',
        'description' => 'Toutes les évaluations non encore validées.',
        'evaluationsList' => $evaluations
    ])
@endsection