@extends('back.layouts.principal')

@section('title', 'Tableaux brouillons')
@section('page_title', 'Chambre marketing · Tableaux brouillons')
@section('page_subtitle', 'Tableaux encore en construction ou en attente de validation.')

@section('content')
    @include('back.chambre-marketing.tableaux-performance._table', [
        'tableaux' => $tableaux,
        'titreBloc' => 'Tableaux brouillons',
        'descriptionBloc' => 'Tableaux de performance non encore publiés.'
    ])
@endsection
