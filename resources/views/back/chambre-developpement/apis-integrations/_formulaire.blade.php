<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de l’API / intégration</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $apiIntegration->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Type d’API</label>
        <select name="type_api" class="form-select form-select-lg rounded-4 @error('type_api') is-invalid @enderror">
            <option value="rest" @selected(old('type_api', $apiIntegration->type_api ?? 'rest') === 'rest')>REST</option>
            <option value="graphql" @selected(old('type_api', $apiIntegration->type_api ?? '') === 'graphql')>GraphQL</option>
            <option value="webhook" @selected(old('type_api', $apiIntegration->type_api ?? '') === 'webhook')>Webhook</option>
            <option value="sdk" @selected(old('type_api', $apiIntegration->type_api ?? '') === 'sdk')>SDK</option>
            <option value="autre" @selected(old('type_api', $apiIntegration->type_api ?? '') === 'autre')>Autre</option>
        </select>
        @error('type_api')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4 @error('auteur_id') is-invalid @enderror">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $apiIntegration->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="conception" @selected(old('statut', $apiIntegration->statut ?? 'conception') === 'conception')>Conception</option>
            <option value="en_developpement" @selected(old('statut', $apiIntegration->statut ?? '') === 'en_developpement')>En développement</option>
            <option value="en_test" @selected(old('statut', $apiIntegration->statut ?? '') === 'en_test')>En test</option>
            <option value="active" @selected(old('statut', $apiIntegration->statut ?? '') === 'active')>Active</option>
            <option value="inactive" @selected(old('statut', $apiIntegration->statut ?? '') === 'inactive')>Inactive</option>
            <option value="archivee" @selected(old('statut', $apiIntegration->statut ?? '') === 'archivee')>Archivée</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $apiIntegration->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Méthode d’authentification</label>
        <input type="text" name="methode_authentification"
            class="form-control form-control-lg rounded-4 @error('methode_authentification') is-invalid @enderror"
            value="{{ old('methode_authentification', $apiIntegration->methode_authentification ?? '') }}">
        @error('methode_authentification')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">URL de base</label>
        <input type="url" name="url_base"
            class="form-control form-control-lg rounded-4 @error('url_base') is-invalid @enderror"
            value="{{ old('url_base', $apiIntegration->url_base ?? '') }}">
        @error('url_base')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">URL de documentation</label>
        <input type="url" name="documentation_url"
            class="form-control form-control-lg rounded-4 @error('documentation_url') is-invalid @enderror"
            value="{{ old('documentation_url', $apiIntegration->documentation_url ?? '') }}">
        @error('documentation_url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
