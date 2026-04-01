@extends('back.layouts.principal')

@section('title', 'Tableaux publiés')
@section('page_title', 'Chambre marketing · Tableaux publiés')
@section('page_subtitle', 'Tableaux de performance validés et publiés pour analyse ou diffusion.')

@section('content')
    @include('back.chambre-marketing.tableaux-performance._table', [
        'tableaux' => $tableaux,
        'titreBloc' => 'Tableaux publiés',
        'descriptionBloc' => 'Tableaux de performance disponibles à la consultation.'
    ])
@endsection
