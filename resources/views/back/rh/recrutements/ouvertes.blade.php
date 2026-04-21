@extends('back.layouts.principal')

@section('title', 'Recrutements ouverts')
@section('page_title', 'Recrutements ouverts')
@section('page_subtitle', 'Liste des campagnes de recrutement actuellement ouvertes et actives.')

@section('content')
    @include('back.rh.recrutements._table-status', [
        'pageTitleInner' => 'Recrutements ouverts',
        'description' => 'Toutes les campagnes ouvertes à candidature.',
        'recrutementsList' => $recrutements
    ])
@endsection