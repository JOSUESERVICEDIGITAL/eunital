@extends('back.layouts.principal')

@section('title', 'Nouvel indicateur')
@section('page_title', 'Nouvel indicateur')
@section('page_subtitle', 'Créer un KPI rattaché à une innovation.')

@section('content')
<div class="content-card">
    <form method="POST" action="{{ route('back.innovations.indicateurs.store') }}">
        @csrf
        @include('back.innovations.indicateurs._form', ['indicateur' => null])
    </form>
</div>

@include('back.innovations.indicateurs._styles')
@endsection
