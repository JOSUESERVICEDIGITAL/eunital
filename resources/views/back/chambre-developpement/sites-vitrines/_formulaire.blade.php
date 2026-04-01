<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre du site</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $siteVitrine->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="maquette" @selected(old('statut', $siteVitrine->statut ?? 'maquette') === 'maquette')>Maquette</option>
            <option value="en_developpement" @selected(old('statut', $siteVitrine->statut ?? '') === 'en_developpement')>En développement</option>
            <option value="en_revision" @selected(old('statut', $siteVitrine->statut ?? '') === 'en_revision')>En révision</option>
            <option value="livre" @selected(old('statut', $siteVitrine->statut ?? '') === 'livre')>Livré</option>
            <option value="en_ligne" @selected(old('statut', $siteVitrine->statut ?? '') === 'en_ligne')>En ligne</option>
            <option value="archive" @selected(old('statut', $siteVitrine->statut ?? '') === 'archive')>Archivé</option>
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
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $siteVitrine->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Client</label>
        <input type="text" name="client"
            class="form-control form-control-lg rounded-4 @error('client') is-invalid @enderror"
            value="{{ old('client', $siteVitrine->client ?? '') }}">
        @error('client')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $siteVitrine->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Technologies</label>
        <textarea name="technologies" rows="5"
            class="form-control rounded-4 @error('technologies') is-invalid @enderror">{{ old('technologies', $siteVitrine->technologies ?? '') }}</textarea>
        @error('technologies')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">URL du site</label>
        <input type="url" name="url_site"
            class="form-control form-control-lg rounded-4 @error('url_site') is-invalid @enderror"
            value="{{ old('url_site', $siteVitrine->url_site ?? '') }}">
        @error('url_site')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date de livraison prévue</label>
        <input type="date" name="date_livraison_prevue"
            class="form-control form-control-lg rounded-4 @error('date_livraison_prevue') is-invalid @enderror"
            value="{{ old('date_livraison_prevue', isset($siteVitrine?->date_livraison_prevue) ? $siteVitrine->date_livraison_prevue->format('Y-m-d') : '') }}">
        @error('date_livraison_prevue')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
