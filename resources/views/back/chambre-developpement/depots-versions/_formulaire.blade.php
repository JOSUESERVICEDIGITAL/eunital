<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre du dépôt / version</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $depotVersion->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="actif" @selected(old('statut', $depotVersion->statut ?? 'actif') === 'actif')>Actif</option>
            <option value="en_preparation" @selected(old('statut', $depotVersion->statut ?? '') === 'en_preparation')>En préparation</option>
            <option value="deploie" @selected(old('statut', $depotVersion->statut ?? '') === 'deploie')>Déployé</option>
            <option value="gele" @selected(old('statut', $depotVersion->statut ?? '') === 'gele')>Gelé</option>
            <option value="archive" @selected(old('statut', $depotVersion->statut ?? '') === 'archive')>Archivé</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4 @error('auteur_id') is-invalid @enderror">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $depotVersion->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de version</label>
        <select name="type_version" class="form-select form-select-lg rounded-4 @error('type_version') is-invalid @enderror">
            <option value="majeure" @selected(old('type_version', $depotVersion->type_version ?? 'mineure') === 'majeure')>Majeure</option>
            <option value="mineure" @selected(old('type_version', $depotVersion->type_version ?? 'mineure') === 'mineure')>Mineure</option>
            <option value="corrective" @selected(old('type_version', $depotVersion->type_version ?? '') === 'corrective')>Corrective</option>
            <option value="hotfix" @selected(old('type_version', $depotVersion->type_version ?? '') === 'hotfix')>Hotfix</option>
        </select>
        @error('type_version')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $depotVersion->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">URL du dépôt</label>
        <input type="url" name="url_depot"
            class="form-control form-control-lg rounded-4 @error('url_depot') is-invalid @enderror"
            value="{{ old('url_depot', $depotVersion->url_depot ?? '') }}">
        @error('url_depot')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Branche principale</label>
        <input type="text" name="branche_principale"
            class="form-control form-control-lg rounded-4 @error('branche_principale') is-invalid @enderror"
            value="{{ old('branche_principale', $depotVersion->branche_principale ?? '') }}">
        @error('branche_principale')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Version actuelle</label>
        <input type="text" name="version_actuelle"
            class="form-control form-control-lg rounded-4 @error('version_actuelle') is-invalid @enderror"
            value="{{ old('version_actuelle', $depotVersion->version_actuelle ?? '1.0.0') }}">
        @error('version_actuelle')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
