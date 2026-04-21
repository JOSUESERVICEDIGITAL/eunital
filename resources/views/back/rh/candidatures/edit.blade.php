@extends('back.layouts.principal')

@section('title', 'Modifier la candidature')
@section('page_title', 'Modifier la candidature')
@section('page_subtitle', 'Mets à jour les informations du candidat, son rattachement et son état d’avancement.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $candidature->nom }} {{ $candidature->prenom }}</h4>
                        <p class="text-muted mb-0">Modification du profil candidat.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.candidatures.show', $candidature) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-eye me-2"></i>Voir
                        </a>
                        <a href="{{ route('rh.candidatures.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('rh.candidatures.update', $candidature) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Recrutement</label>
                            <select name="recrutement_id" class="form-select custom-input @error('recrutement_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($recrutements as $recrutement)
                                    <option value="{{ $recrutement->id }}" @selected(old('recrutement_id', $candidature->recrutement_id) == $recrutement->id)>
                                        {{ $recrutement->titre }}
                                        @if($recrutement->departement) — {{ $recrutement->departement->nom }} @endif
                                        @if($recrutement->poste) / {{ $recrutement->poste->nom }} @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('recrutement_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Nom</label>
                            <input type="text" name="nom" class="form-control custom-input @error('nom') is-invalid @enderror"
                                   value="{{ old('nom', $candidature->nom) }}">
                            @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Prénom</label>
                            <input type="text" name="prenom" class="form-control custom-input @error('prenom') is-invalid @enderror"
                                   value="{{ old('prenom', $candidature->prenom) }}">
                            @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror"
                                   value="{{ old('email', $candidature->email) }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Téléphone</label>
                            <input type="text" name="telephone" class="form-control custom-input @error('telephone') is-invalid @enderror"
                                   value="{{ old('telephone', $candidature->telephone) }}">
                            @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', $candidature->statut) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Référence CV</label>
                            <input type="text" name="cv" class="form-control custom-input @error('cv') is-invalid @enderror"
                                   value="{{ old('cv', $candidature->cv) }}">
                            @error('cv') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Lettre de motivation</label>
                            <input type="text" name="lettre_motivation" class="form-control custom-input @error('lettre_motivation') is-invalid @enderror"
                                   value="{{ old('lettre_motivation', $candidature->lettre_motivation) }}">
                            @error('lettre_motivation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date de candidature</label>
                            <input type="date" name="date_candidature" class="form-control custom-input @error('date_candidature') is-invalid @enderror"
                                   value="{{ old('date_candidature', optional($candidature->date_candidature)->format('Y-m-d')) }}">
                            @error('date_candidature') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Observation RH</label>
                            <textarea name="observation" rows="5" class="form-control rounded-4 @error('observation') is-invalid @enderror">{{ old('observation', $candidature->observation) }}</textarea>
                            @error('observation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Mettre à jour
                                </button>
                                <a href="{{ route('rh.candidatures.show', $candidature) }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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