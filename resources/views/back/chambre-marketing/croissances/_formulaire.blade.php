<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de l’action</label>
        <input type="text" name="titre"
               class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
               value="{{ old('titre', $croissanceMarketing->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="planifiee" @selected(old('statut', $croissanceMarketing->statut ?? 'planifiee') === 'planifiee')>Planifiée</option>
            <option value="en_cours" @selected(old('statut', $croissanceMarketing->statut ?? '') === 'en_cours')>En cours</option>
            <option value="test" @selected(old('statut', $croissanceMarketing->statut ?? '') === 'test')>Test</option>
            <option value="validee" @selected(old('statut', $croissanceMarketing->statut ?? '') === 'validee')>Validée</option>
            <option value="abandonnee" @selected(old('statut', $croissanceMarketing->statut ?? '') === 'abandonnee')>Abandonnée</option>
            <option value="archivee" @selected(old('statut', $croissanceMarketing->statut ?? '') === 'archivee')>Archivée</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}"
                    @selected(old('auteur_id', $croissanceMarketing->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}"
                    @selected(old('responsable_id', $croissanceMarketing->responsable_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Objectif</label>
        <input type="text" name="objectif"
               class="form-control form-control-lg rounded-4"
               value="{{ old('objectif', $croissanceMarketing->objectif ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Levier</label>
        <input type="text" name="levier"
               class="form-control form-control-lg rounded-4"
               value="{{ old('levier', $croissanceMarketing->levier ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Métrique cible</label>
        <input type="text" name="metrique_cible"
               class="form-control form-control-lg rounded-4"
               value="{{ old('metrique_cible', $croissanceMarketing->metrique_cible ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Priorité</label>
        <select name="priorite" class="form-select form-select-lg rounded-4 @error('priorite') is-invalid @enderror">
            <option value="faible" @selected(old('priorite', $croissanceMarketing->priorite ?? 'moyenne') === 'faible')>Faible</option>
            <option value="moyenne" @selected(old('priorite', $croissanceMarketing->priorite ?? 'moyenne') === 'moyenne')>Moyenne</option>
            <option value="haute" @selected(old('priorite', $croissanceMarketing->priorite ?? '') === 'haute')>Haute</option>
            <option value="critique" @selected(old('priorite', $croissanceMarketing->priorite ?? '') === 'critique')>Critique</option>
        </select>
        @error('priorite')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Date début</label>
        <input type="date" name="date_debut"
               class="form-control form-control-lg rounded-4"
               value="{{ old('date_debut', isset($croissanceMarketing?->date_debut) ? $croissanceMarketing->date_debut->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Date fin</label>
        <input type="date" name="date_fin"
               class="form-control form-control-lg rounded-4"
               value="{{ old('date_fin', isset($croissanceMarketing?->date_fin) ? $croissanceMarketing->date_fin->format('Y-m-d') : '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Action prévue</label>
        <textarea name="action_prevue" rows="5" class="form-control rounded-4">{{ old('action_prevue', $croissanceMarketing->action_prevue ?? '') }}</textarea>
    </div>
</div>