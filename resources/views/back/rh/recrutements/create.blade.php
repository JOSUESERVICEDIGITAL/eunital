@extends('back.layouts.principal')

@section('title', 'Créer un recrutement')
@section('page_title', 'Créer un recrutement')
@section('page_subtitle', 'Ouvre une nouvelle campagne RH avec poste, département, responsable, type de contrat et description détaillée.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Nouveau recrutement</h4>
                        <p class="text-muted mb-0">Crée une campagne de recrutement structurée et pilotable dans le hub.</p>
                    </div>
                    <a href="{{ route('rh.recrutements.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <form method="POST" action="{{ route('rh.recrutements.store') }}">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Titre</label>
                            <input type="text" name="titre" class="form-control custom-input @error('titre') is-invalid @enderror"
                                   value="{{ old('titre') }}" placeholder="Ex: Recrutement développeur full-stack">
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" class="form-control custom-input @error('slug') is-invalid @enderror"
                                   value="{{ old('slug') }}" placeholder="Auto si vide">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Département</label>
                            <select name="departement_id" class="form-select custom-input @error('departement_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($departements as $departement)
                                    <option value="{{ $departement->id }}" @selected(old('departement_id') == $departement->id)>
                                        {{ $departement->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departement_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Poste</label>
                            <select name="poste_id" class="form-select custom-input @error('poste_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($postes as $poste)
                                    <option value="{{ $poste->id }}" @selected(old('poste_id') == $poste->id)>
                                        {{ $poste->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('poste_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Responsable</label>
                            <select name="responsable_id" class="form-select custom-input @error('responsable_id') is-invalid @enderror">
                                <option value="">Aucun</option>
                                @foreach($responsables as $responsable)
                                    <option value="{{ $responsable->id }}" @selected(old('responsable_id') == $responsable->id)>
                                        {{ $responsable->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('responsable_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Type de contrat</label>
                            <select name="type_contrat" class="form-select custom-input @error('type_contrat') is-invalid @enderror">
                                @foreach($typesContrat as $key => $label)
                                    <option value="{{ $key }}" @selected(old('type_contrat', 'cdi') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_contrat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
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

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Date d’ouverture</label>
                            <input type="date" name="date_ouverture" class="form-control custom-input @error('date_ouverture') is-invalid @enderror"
                                   value="{{ old('date_ouverture') }}">
                            @error('date_ouverture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Date de clôture</label>
                            <input type="date" name="date_cloture" class="form-control custom-input @error('date_cloture') is-invalid @enderror"
                                   value="{{ old('date_cloture') }}">
                            @error('date_cloture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="6" class="form-control rounded-4 @error('description') is-invalid @enderror"
                                      placeholder="Décris le besoin, les responsabilités, le profil attendu, les enjeux...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                                <a href="{{ route('rh.recrutements.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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