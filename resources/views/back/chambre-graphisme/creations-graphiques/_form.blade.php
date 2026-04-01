<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche création graphique</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $creation->titre ?? '') }}"
                           placeholder="Ex : Identité visuelle campagne, bannière, visuel promotionnel...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="logo" @selected(old('type', $creation->type ?? '') == 'logo')>Logo</option>
                        <option value="affiche" @selected(old('type', $creation->type ?? '') == 'affiche')>Affiche</option>
                        <option value="reseaux" @selected(old('type', $creation->type ?? '') == 'reseaux')>Réseaux</option>
                        <option value="uiux" @selected(old('type', $creation->type ?? '') == 'uiux')>UI/UX</option>
                        <option value="branding" @selected(old('type', $creation->type ?? '') == 'branding')>Branding</option>
                        <option value="autre" @selected(old('type', $creation->type ?? 'autre') == 'autre')>Autre</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id" class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $creation->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Projet</label>
                    <select name="projet_studio_id" class="form-select form-select-lg rounded-4 @error('projet_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($projets as $projet)
                            <option value="{{ $projet->id }}"
                                @selected(old('projet_studio_id', $creation->projet_studio_id ?? '') == $projet->id)>
                                {{ $projet->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('projet_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="brouillon" @selected(old('statut', $creation->statut ?? 'brouillon') == 'brouillon')>Brouillon</option>
                        <option value="en_cours" @selected(old('statut', $creation->statut ?? '') == 'en_cours')>En cours</option>
                        <option value="validation" @selected(old('statut', $creation->statut ?? '') == 'validation')>Validation</option>
                        <option value="livre" @selected(old('statut', $creation->statut ?? '') == 'livre')>Livrée</option>
                        <option value="archive" @selected(old('statut', $creation->statut ?? '') == 'archive')>Archivée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Auteur</label>
                    <select name="auteur_id" class="form-select form-select-lg rounded-4 @error('auteur_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($auteurs as $auteur)
                            <option value="{{ $auteur->id }}"
                                @selected(old('auteur_id', $creation->auteur_id ?? '') == $auteur->id)>
                                {{ $auteur->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('auteur_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Fichier</label>
                    <input type="text"
                           name="fichier"
                           class="form-control form-control-lg rounded-4 @error('fichier') is-invalid @enderror"
                           value="{{ old('fichier', $creation->fichier ?? '') }}"
                           placeholder="Ex : graphisme/logo-v3.png">
                    @error('fichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description"
                              rows="5"
                              class="form-control rounded-4 @error('description') is-invalid @enderror"
                              placeholder="Décris ici le besoin graphique, le style attendu, les contraintes et les objectifs...">{{ old('description', $creation->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>