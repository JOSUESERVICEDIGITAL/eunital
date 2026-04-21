@extends('back.layouts.principal')

@section('title', 'Historique des congés')
@section('page_title', 'Historique des congés')
@section('page_subtitle', 'Chronologie globale des demandes de congé avec filtres de traçabilité RH.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.conges.historique') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Employé</label>
                            <select name="membre_equipe_id" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($membres as $membre)
                                    <option value="{{ $membre->id }}" @selected(request('membre_equipe_id') == $membre->id)>
                                        {{ $membre->nom }} {{ $membre->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(request('statut') == $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Filtrer</button>
                                <a href="{{ route('rh.conges.historique') }}" class="btn btn-outline-secondary rounded-pill px-4">Réinitialiser</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.conges._table-status', [
                'pageTitleInner' => 'Historique global',
                'description' => 'Toutes les modifications et états des demandes de congé.',
                'congesList' => $conges,
                'showValidationActions' => false
            ])
        </div>

    </div>

    <style>
        .custom-input{height:48px;border-radius:16px}
    </style>
@endsection