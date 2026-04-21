@extends('back.layouts.principal')

@section('title', 'Historique des sanctions')
@section('page_title', 'Historique des sanctions')
@section('page_subtitle', 'Chronologie globale des sanctions disciplinaires avec filtres de traçabilité RH.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <form method="GET" action="{{ route('rh.sanctions.historique') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
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

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type_sanction" class="form-select custom-input">
                                <option value="">Tous</option>
                                @foreach($typesSanction as $key => $label)
                                    <option value="{{ $key }}" @selected(request('type_sanction') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

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

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Filtrer</button>
                                <a href="{{ route('rh.sanctions.historique') }}" class="btn btn-outline-secondary rounded-pill px-4">Réinitialiser</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12">
            @include('back.rh.sanctions._table-status', [
                'pageTitleInner' => 'Historique disciplinaire global',
                'description' => 'Toutes les sanctions enregistrées avec filtres appliqués.',
                'sanctionsList' => $sanctions
            ])
        </div>

    </div>

    <style>
        .custom-input{height:48px;border-radius:16px}
    </style>
@endsection