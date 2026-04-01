<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4" value="{{ old('titre', $architectureTechnique->titre ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Version</label>
        <input type="text" name="version" class="form-control form-control-lg rounded-4" value="{{ old('version', $architectureTechnique->version ?? '1.0') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $architectureTechnique->auteur_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="brouillon" @selected(old('statut', $architectureTechnique->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="validee" @selected(old('statut', $architectureTechnique->statut ?? '') === 'validee')>Validée</option>
            <option value="obsolete" @selected(old('statut', $architectureTechnique->statut ?? '') === 'obsolete')>Obsolète</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4" class="form-control rounded-4">{{ old('description', $architectureTechnique->description ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Composants</label>
        <textarea name="composants" rows="6" class="form-control rounded-4">{{ old('composants', $architectureTechnique->composants ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Technologies recommandées</label>
        <textarea name="technologies_recommandees" rows="6" class="form-control rounded-4">{{ old('technologies_recommandees', $architectureTechnique->technologies_recommandees ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Contraintes techniques</label>
        <textarea name="contraintes_techniques" rows="5" class="form-control rounded-4">{{ old('contraintes_techniques', $architectureTechnique->contraintes_techniques ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Diagramme</label>
        <input type="file" name="diagramme" class="form-control form-control-lg rounded-4">
    </div>
</div>