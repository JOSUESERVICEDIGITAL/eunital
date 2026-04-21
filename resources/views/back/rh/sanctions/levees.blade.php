@extends('back.layouts.principal')

@section('title', 'Sanctions levées')
@section('page_title', 'Sanctions levées')
@section('page_subtitle', 'Liste des sanctions dont les effets ont été levés.')

@section('content')
    @include('back.rh.sanctions._table-status', [
        'pageTitleInner' => 'Sanctions levées',
        'description' => 'Toutes les sanctions levées.',
        'sanctionsList' => $sanctions
    ])
@endsection