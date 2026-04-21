@extends('back.layouts.principal')

@section('title', 'Nouvelle demande de congé')
@section('page_title', 'Nouvelle demande de congé')
@section('page_subtitle', 'Crée une demande de congé RH avec type, période, motif, statut initial et validateur éventuel.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Créer une demande de congé</h4>
                        <p class="text-muted mb-0">Remplis les informations du congé à enregistrer dans le hub RH.</p>
                    </div>
                    <a href="{{ route('rh.conges.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <form method="POST" action="{{ route('rh.conges.store') }}">
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
                            <label class="form-label fw-semibold">Type de congé</label>
                            <select name="type_conge" class="form-select custom-input @error('type_conge') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($typesConge as $key => $label)
                                    <option value="{{ $key }}" @selected(old('type_conge') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_conge') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Date début</label>
                            <input type="date" name="date_debut" class="form-control custom-input @error('date_debut') is-invalid @enderror"
                                   value="{{ old('date_debut') }}">
                            @error('date_debut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Date fin</label>
                            <input type="date" name="date_fin" class="form-control custom-input @error('date_fin') is-invalid @enderror"
                                   value="{{ old('date_fin') }}">
                            @error('date_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nombre de jours</label>
                            <input type="number" min="1" name="nombre_jours" class="form-control custom-input @error('nombre_jours') is-invalid @enderror"
                                   value="{{ old('nombre_jours') }}" placeholder="Auto si vide">
                            @error('nombre_jours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Statut initial</label>
                            <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', 'en_attente') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Validateur</label>
                            <select name="valide_par" class="form-select custom-input @error('valide_par') is-invalid @enderror">
                                <option value="">Aucun</option>
                                @foreach($validateurs as $validateur)
                                    <option value="{{ $validateur->id }}" @selected(old('valide_par') == $validateur->id)>
                                        {{ $validateur->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('valide_par') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Motif</label>
                            <textarea name="motif" rows="5" class="form-control rounded-4 @error('motif') is-invalid @enderror"
                                      placeholder="Motif de la demande de congé...">{{ old('motif') }}</textarea>
                            @error('motif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                                <a href="{{ route('rh.conges.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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