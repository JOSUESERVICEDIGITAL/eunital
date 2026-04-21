@extends('back.layouts.principal')

@section('title', 'Modifier le dossier bien-être')
@section('page_title', 'Modifier le dossier bien-être')
@section('page_subtitle', 'Mets à jour les informations d’un dossier de bien-être et son suivi RH.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $dossier->titre }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.bien-etre.show', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-eye me-2"></i>Voir
                        </a>
                        <a href="{{ route('rh.bien-etre.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('rh.bien-etre.update', $dossier) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Employé</label>
                            <select name="membre_equipe_id" class="form-select custom-input @error('membre_equipe_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($membres as $membre)
                                    <option value="{{ $membre->id }}" @selected(old('membre_equipe_id', $dossier->membre_equipe_id) == $membre->id)>
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
                                    <option value="{{ $auteur->id }}" @selected(old('auteur_id', $dossier->auteur_id) == $auteur->id)>
                                        {{ $auteur->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('auteur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Titre</label>
                            <input type="text" name="titre" class="form-control custom-input @error('titre') is-invalid @enderror"
                                   value="{{ old('titre', $dossier->titre) }}">
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type" class="form-select custom-input @error('type') is-invalid @enderror">
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}" @selected(old('type', $dossier->type) == $key)>
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
                                    <option value="{{ $key }}" @selected(old('niveau_priorite', $dossier->niveau_priorite) == $key)>
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
                                    <option value="{{ $key }}" @selected(old('statut', $dossier->statut) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="6" class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $dossier->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Mettre à jour
                                </button>
                                <a href="{{ route('rh.bien-etre.show', $dossier) }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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