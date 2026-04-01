<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4" value="{{ old('titre', $dossierTechnique->titre ?? '') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Version</label>
        <input type="text" name="version" class="form-control form-control-lg rounded-4" value="{{ old('version', $dossierTechnique->version ?? '1.0') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="brouillon" @selected(old('statut', $dossierTechnique->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="publie" @selected(old('statut', $dossierTechnique->statut ?? '') === 'publie')>Publié</option>
            <option value="archive" @selected(old('statut', $dossierTechnique->statut ?? '') === 'archive')>Archivé</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $dossierTechnique->auteur_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de dossier</label>
        <select name="type_dossier" class="form-select form-select-lg rounded-4">
            <option value="specification" @selected(old('type_dossier', $dossierTechnique->type_dossier ?? 'documentation') === 'specification')>Spécification</option>
            <option value="documentation" @selected(old('type_dossier', $dossierTechnique->type_dossier ?? 'documentation') === 'documentation')>Documentation</option>
            <option value="procedure" @selected(old('type_dossier', $dossierTechnique->type_dossier ?? '') === 'procedure')>Procédure</option>
            <option value="manuel" @selected(old('type_dossier', $dossierTechnique->type_dossier ?? '') === 'manuel')>Manuel</option>
            <option value="analyse" @selected(old('type_dossier', $dossierTechnique->type_dossier ?? '') === 'analyse')>Analyse</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Résumé</label>
        <textarea name="resume" rows="5" class="form-control rounded-4">{{ old('resume', $dossierTechnique->resume ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Document principal</label>
        <input type="file" name="document_principal" class="form-control form-control-lg rounded-4">
    </div>
</div>