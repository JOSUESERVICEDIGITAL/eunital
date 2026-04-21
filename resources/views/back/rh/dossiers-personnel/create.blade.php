@extends('back.layouts.principal')

@section('title', 'Créer un dossier du personnel')
@section('page_title', 'Créer un dossier du personnel')
@section('page_subtitle', 'Ajoute une nouvelle fiche RH complète avec identité, matricule, situation professionnelle et données administratives.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Nouveau dossier RH</h4>
                        <p class="text-muted mb-0">Renseigne les informations essentielles du collaborateur.</p>
                    </div>
                    <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <form method="POST" action="{{ route('rh.dossiers-personnel.store') }}">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Membre de l’équipe</label>
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
                            <label class="form-label fw-semibold">Matricule</label>
                            <input type="text" name="matricule" class="form-control custom-input @error('matricule') is-invalid @enderror"
                                   value="{{ old('matricule') }}" placeholder="Ex: RH-EMP-001">
                            @error('matricule') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Numéro CNSS</label>
                            <input type="text" name="numero_cnss" class="form-control custom-input @error('numero_cnss') is-invalid @enderror"
                                   value="{{ old('numero_cnss') }}">
                            @error('numero_cnss') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pièce d’identité</label>
                            <input type="text" name="numero_piece_identite" class="form-control custom-input @error('numero_piece_identite') is-invalid @enderror"
                                   value="{{ old('numero_piece_identite') }}">
                            @error('numero_piece_identite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Statut professionnel</label>
                            <select name="statut_professionnel" class="form-select custom-input @error('statut_professionnel') is-invalid @enderror">
                                @foreach($statutsProfessionnels as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut_professionnel', 'en_poste') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut_professionnel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control custom-input @error('date_naissance') is-invalid @enderror"
                                   value="{{ old('date_naissance') }}">
                            @error('date_naissance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date d’embauche</label>
                            <input type="date" name="date_embauche" class="form-control custom-input @error('date_embauche') is-invalid @enderror"
                                   value="{{ old('date_embauche') }}">
                            @error('date_embauche') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salaire de base</label>
                            <input type="number" step="0.01" name="salaire_base"
                                   class="form-control custom-input @error('salaire_base') is-invalid @enderror"
                                   value="{{ old('salaire_base') }}" placeholder="0.00">
                            @error('salaire_base') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Adresse</label>
                            <input type="text" name="adresse" class="form-control custom-input @error('adresse') is-invalid @enderror"
                                   value="{{ old('adresse') }}">
                            @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Notes RH</label>
                            <textarea name="notes" rows="5" class="form-control rounded-4 @error('notes') is-invalid @enderror"
                                      placeholder="Observations, informations administratives, contexte RH...">{{ old('notes') }}</textarea>
                            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                                <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-light rounded-pill px-4">
                                    Annuler
                                </a>
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