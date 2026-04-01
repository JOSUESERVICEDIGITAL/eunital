<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de l’idée</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $ideeIngenieurie->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Priorité</label>
        <select name="niveau_priorite" class="form-select form-select-lg rounded-4 @error('niveau_priorite') is-invalid @enderror">
            <option value="faible" @selected(old('niveau_priorite', $ideeIngenieurie->niveau_priorite ?? 'moyenne') === 'faible')>Faible</option>
            <option value="moyenne" @selected(old('niveau_priorite', $ideeIngenieurie->niveau_priorite ?? 'moyenne') === 'moyenne')>Moyenne</option>
            <option value="haute" @selected(old('niveau_priorite', $ideeIngenieurie->niveau_priorite ?? '') === 'haute')>Haute</option>
            <option value="critique" @selected(old('niveau_priorite', $ideeIngenieurie->niveau_priorite ?? '') === 'critique')>Critique</option>
        </select>
        @error('niveau_priorite')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4 @error('auteur_id') is-invalid @enderror">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $ideeIngenieurie->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }} - {{ $utilisateur->email }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4 @error('responsable_id') is-invalid @enderror">
            <option value="">Aucun responsable</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('responsable_id', $ideeIngenieurie->responsable_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('responsable_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $ideeIngenieurie->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Problème identifié</label>
        <textarea name="probleme_identifie" rows="6"
            class="form-control rounded-4 @error('probleme_identifie') is-invalid @enderror">{{ old('probleme_identifie', $ideeIngenieurie->probleme_identifie ?? '') }}</textarea>
        @error('probleme_identifie')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Solution proposée</label>
        <textarea name="solution_proposee" rows="6"
            class="form-control rounded-4 @error('solution_proposee') is-invalid @enderror">{{ old('solution_proposee', $ideeIngenieurie->solution_proposee ?? '') }}</textarea>
        @error('solution_proposee')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="nouvelle" @selected(old('statut', $ideeIngenieurie->statut ?? 'nouvelle') === 'nouvelle')>Nouvelle</option>
            <option value="en_etude" @selected(old('statut', $ideeIngenieurie->statut ?? '') === 'en_etude')>En étude</option>
            <option value="retenue" @selected(old('statut', $ideeIngenieurie->statut ?? '') === 'retenue')>Retenue</option>
            <option value="rejetee" @selected(old('statut', $ideeIngenieurie->statut ?? '') === 'rejetee')>Rejetée</option>
            <option value="realisee" @selected(old('statut', $ideeIngenieurie->statut ?? '') === 'realisee')>Réalisée</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>