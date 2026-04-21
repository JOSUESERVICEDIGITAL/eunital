@extends('back.layouts.principal')

@section('title', 'Nouveau dossier bien-être')
@section('page_title', 'Nouveau dossier bien-être')
@section('page_subtitle', 'Crée un dossier de suivi humain, social ou d’accompagnement pour un collaborateur.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Créer un dossier bien-être</h4>
                        <p class="text-muted mb-0">Ajoute un nouveau dossier de bien-être au travail dans le hub RH.</p>
                    </div>
                    <a href="{{ route('rh.bien-etre.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <form method="POST" action="{{ route('rh.bien-etre.store') }}">
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
                            <label class="form-label fw-semibold">Auteur</label>
                            <select name="auteur_id" class="form-select custom-input @error('auteur_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($auteurs as $auteur)
                                    <option value="{{ $auteur->id }}" @selected(old('auteur_id') == $auteur->id)>
                                        {{ $auteur->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('auteur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Titre</label>
                            <input type="text" name="titre" class="form-control custom-input @error('titre') is-invalid @enderror"
                                   value="{{ old('titre') }}" placeholder="Ex: Signalement climat d’équipe">
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type" class="form-select custom-input @error('type') is-invalid @enderror">
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}" @selected(old('type') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Priorité</label>
                            <select name="niveau_priorite" class="form-select custom-input @error('niveau_priorite') is-invalid @enderror">
                                @foreach($priorites as $key => $label)
                                    <option value="{{ $key }}" @selected(old('niveau_priorite', 'moyenne') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('niveau_priorite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', 'ouvert') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="6" class="form-control rounded-4 @error('description') is-invalid @enderror"
                                      placeholder="Décris le contexte, la situation, le besoin d’accompagnement ou le signalement...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                                <a href="{{ route('rh.bien-etre.index') }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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