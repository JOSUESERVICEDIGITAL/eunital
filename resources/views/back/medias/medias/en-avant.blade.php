@extends('back.layouts.principal')
@section('title', 'Médias en avant')
@section('page_title', 'Médias en avant')
@section('page_subtitle', 'Ressources médias mises en avant sur le hub ou le front.')
@section('content')
    @include('back.medias.medias._liste-type', [
        'medias' => $medias,
        'titreBloc' => 'Médias en avant',
        'descriptionBloc' => 'Médias marqués comme prioritaires.'
    ])
@endsection