@extends('back.layouts.principal')

@section('title', 'Modifier la sanction')
@section('page_title', 'Modifier la sanction')
@section('page_subtitle', 'Mets à jour les informations d’une sanction disciplinaire existante.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $sanction->motif }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($sanction->membreEquipe)->nom }} {{ optional($sanction->membreEquipe)->prenom }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.sanctions.show', $sanction) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-eye me-2"></i>Voir
                        </a>
                        <a href="{{ route('rh.sanctions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('rh.sanctions.update', $sanction) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Employé</label>
                            <select name="membre_equipe_id" class="form-select custom-input @error('membre_equipe_id') is-invalid @enderror">
                                <option value="">Sélectionner</option>
                                @foreach($membres as $membre)
                                    <option value="{{ $membre->id }}" @selected(old('membre_equipe_id', $sanction->membre_equipe_id) == $membre->id)>
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
                                    <option value="{{ $auteur->id }}" @selected(old('auteur_id', $sanction->auteur_id) == $auteur->id)>
                                        {{ $auteur->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('auteur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Type de sanction</label>
                            <select name="type_sanction" class="form-select custom-input @error('type_sanction') is-invalid @enderror">
                                @foreach($typesSanction as $key => $label)
                                    <option value="{{ $key }}" @selected(old('type_sanction', $sanction->type_sanction) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_sanction') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', $sanction->statut) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Date de sanction</label>
                            <input type="date" name="date_sanction" class="form-control custom-input @error('date_sanction') is-invalid @enderror"
                                   value="{{ old('date_sanction', optional($sanction->date_sanction)->format('Y-m-d')) }}">
                            @error('date_sanction') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Motif</label>
                            <input type="text" name="motif" class="form-control custom-input @error('motif') is-invalid @enderror"
                                   value="{{ old('motif', $sanction->motif) }}">
                            @error('motif') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="6" class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $sanction->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Mettre à jour
                                </button>
                                <a href="{{ route('rh.sanctions.show', $sanction) }}" class="btn btn-light rounded-pill px-4">Annuler</a>
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