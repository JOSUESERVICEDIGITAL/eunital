<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4" value="{{ old('titre', $applicationWeb->titre ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Version</label>
        <input type="text" name="version" class="form-control form-control-lg rounded-4" value="{{ old('version', $applicationWeb->version ?? '1.0') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $applicationWeb->auteur_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('responsable_id', $applicationWeb->responsable_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Priorité</label>
        <select name="priorite" class="form-select form-select-lg rounded-4">
            <option value="faible" @selected(old('priorite', $applicationWeb->priorite ?? 'moyenne') === 'faible')>Faible</option>
            <option value="moyenne" @selected(old('priorite', $applicationWeb->priorite ?? 'moyenne') === 'moyenne')>Moyenne</option>
            <option value="haute" @selected(old('priorite', $applicationWeb->priorite ?? '') === 'haute')>Haute</option>
            <option value="critique" @selected(old('priorite', $applicationWeb->priorite ?? '') === 'critique')>Critique</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="conception" @selected(old('statut', $applicationWeb->statut ?? 'conception') === 'conception')>Conception</option>
            <option value="en_developpement" @selected(old('statut', $applicationWeb->statut ?? '') === 'en_developpement')>En développement</option>
            <option value="en_test" @selected(old('statut', $applicationWeb->statut ?? '') === 'en_test')>En test</option>
            <option value="en_ligne" @selected(old('statut', $applicationWeb->statut ?? '') === 'en_ligne')>En ligne</option>
            <option value="suspendue" @selected(old('statut', $applicationWeb->statut ?? '') === 'suspendue')>Suspendue</option>
            <option value="archivee" @selected(old('statut', $applicationWeb->statut ?? '') === 'archivee')>Archivée</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4" class="form-control rounded-4">{{ old('description', $applicationWeb->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Stack technique</label>
        <textarea name="stack_technique" rows="5" class="form-control rounded-4">{{ old('stack_technique', $applicationWeb->stack_technique ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">URL production</label>
        <input type="url" name="url_production" class="form-control form-control-lg rounded-4" value="{{ old('url_production', $applicationWeb->url_production ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">URL staging</label>
        <input type="url" name="url_staging" class="form-control form-control-lg rounded-4" value="{{ old('url_staging', $applicationWeb->url_staging ?? '') }}">
    </div>
</div>
