@extends('back.layouts.principal')

@section('title', 'Nouvelle évaluation')
@section('page_title', 'Nouvelle évaluation')
@section('page_subtitle', 'Crée une évaluation RH structurée avec employé, évaluateur, note et axes de progression.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Créer une évaluation</h4>
                        <p class="text-muted mb-0">Ajoute une nouvelle évaluation de performance ou de suivi RH.</p>
                    </div>
                    <a href="{{ route('rh.evaluations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <form method="POST" action="{{ route('rh.evaluations.store') }}">
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

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Évaluateur</label>
                            <select name="evaluateur_id" class="form-select custom-input @error('evaluateur_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($evaluateurs as $evaluateur)
                                    <option value="{{ $evaluateur->id }}" @selected(old('evaluateur_id') == $evaluateur->id)>
                                        {{ $evaluateur->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('evaluateur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Titre</label>
                            <input type="text" name="titre" class="form-control custom-input @error('titre') is-invalid @enderror"
                                   value="{{ old('titre') }}" placeholder="Ex: Évaluation annuelle 2026">
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Date d’évaluation</label>
                            <input type="date" name="date_evaluation" class="form-control custom-input @error('date_evaluation') is-invalid @enderror"
                                   value="{{ old('date_evaluation') }}">
                            @error('date_evaluation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Note globale</label>
                            <input type="number" min="0" max="10" step="0.1" name="note_globale"
                                   class="form-control custom-input @error('note_globale') is-invalid @enderror"
                                   value="{{ old('note_globale') }}">
                            @error('note_globale') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', 'brouillon') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Points forts</label>
                            <textarea name="points_forts" rows="4" class="form-control rounded-4 @error('points_forts') is-invalid @enderror"
                                      placeholder="Qualités, compétences démontrées, résultats positifs...">{{ old('points_forts') }}</textarea>
                            @error('points_forts') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Points à améliorer</label>
                            <textarea name="points_a_ameliorer" rows="4" class="form-control rounded-4 @error('points_a_ameliorer') is-invalid @enderror"
                                      placeholder="Axes de progression, blocages, besoins d’accompagnement...">{{ old('points_a_ameliorer') }}</textarea>
                            @error('points_a_ameliorer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Recommandations</label>
                            <textarea name="recommandations" rows="4" class="form-control rounded-4 @error('recommandations') is-invalid @enderror"
                                      placeholder="Recommandations RH, plan d’action, décisions, coaching...">{{ old('recommandations') }}</textarea>
                            @error('recommandations') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                                <a href="{{ route('rh.evaluations.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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