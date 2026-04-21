@extends('back.layouts.principal')

@section('title', 'Candidatures par recrutement')
@section('page_title', 'Candidatures par recrutement')
@section('page_subtitle', 'Vue ciblée des profils rattachés à une campagne donnée avec accès direct aux décisions RH.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $recrutement->titre }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($recrutement->departement)->nom ?? 'Département non défini' }}
                            • {{ optional($recrutement->poste)->nom ?? 'Poste non défini' }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.recrutements.show', $recrutement) }}" class="btn btn-outline-primary rounded-pill px-4">Fiche recrutement</a>
                        <a href="{{ route('rh.recrutements.pipeline', $recrutement) }}" class="btn btn-outline-info rounded-pill px-4">Pipeline</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.candidatures.par-recrutement', $recrutement) }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(request('statut') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-9 d-flex align-items-end">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Filtrer</button>
                                <a href="{{ route('rh.candidatures.par-recrutement', $recrutement) }}" class="btn btn-outline-secondary rounded-pill px-4">Réinitialiser</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.candidatures._table-status', [
                'pageTitleInner' => 'Candidatures du recrutement',
                'description' => 'Liste des profils reçus pour cette campagne.',
                'candidaturesList' => $candidatures
            ])
        </div>

    </div>

    <style>
        .custom-input{height:48px;border-radius:16px}
    </style>
@endsection