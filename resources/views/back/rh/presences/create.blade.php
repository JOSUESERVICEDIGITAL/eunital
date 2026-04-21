@extends('back.layouts.principal')

@section('title', 'Nouvelle présence')
@section('page_title', 'Nouvelle présence')
@section('page_subtitle', 'Enregistre un pointage RH manuel avec date, horaires, statut et observation.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Créer un pointage</h4>
                        <p class="text-muted mb-0">Ajoute une présence ou une absence dans le système RH.</p>
                    </div>
                    <a href="{{ route('rh.presences.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <form method="POST" action="{{ route('rh.presences.store') }}">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Employé</label>
                            <select name="membre_equipe_id" class="form-select custom-input @error('membre_equipe_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($membres as $membre)
                                    <option value="{{ $membre->id }}" @selected(old('membre_equipe_id') == $membre->id)>
                                        {{ $membre->nom }} {{ $membre->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('membre_equipe_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date</label>
                            <input type="date" name="date_presence" class="form-control custom-input @error('date_presence') is-invalid @enderror"
                                   value="{{ old('date_presence') }}">
                            @error('date_presence') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', 'present') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Heure d’arrivée</label>
                            <input type="time" name="heure_arrivee" class="form-control custom-input @error('heure_arrivee') is-invalid @enderror"
                                   value="{{ old('heure_arrivee') }}">
                            @error('heure_arrivee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Heure de départ</label>
                            <input type="time" name="heure_depart" class="form-control custom-input @error('heure_depart') is-invalid @enderror"
                                   value="{{ old('heure_depart') }}">
                            @error('heure_depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Observation</label>
                            <textarea name="observation" rows="5" class="form-control rounded-4 @error('observation') is-invalid @enderror"
                                      placeholder="Commentaire RH, contexte, justification...">{{ old('observation') }}</textarea>
                            @error('observation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                                <a href="{{ route('rh.presences.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        .custom-input{height:50px;border-radius:16px}
    </style>
@endsection