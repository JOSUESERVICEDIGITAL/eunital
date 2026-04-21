@extends('back.layouts.principal')

@section('title', 'Recrutements du département')
@section('page_title', 'Recrutements du département')
@section('page_subtitle', 'Vue ciblée des campagnes de recrutement rattachées à un département donné.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $departement->nom }}</h4>
                        <p class="text-muted mb-0">Recrutements liés à ce département.</p>
                    </div>
                    <a href="{{ route('rh.recrutements.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Tous les recrutements
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.recrutements._table-status', [
                'pageTitleInner' => 'Campagnes du département',
                'description' => 'Toutes les campagnes rattachées à ' . $departement->nom . '.',
                'recrutementsList' => $recrutements
            ])
        </div>
    </div>
@endsection