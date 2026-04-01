<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche de session audio</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre de la session</label>
                    <input type="text"
                        name="titre"
                        class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                        value="{{ old('titre', $productionAudio->titre ?? '') }}"
                        placeholder="Ex : Podcast épisode 03, Single officiel, Session voix-off...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="voix" @selected(old('type', $productionAudio->type ?? 'voix') == 'voix')>Voix</option>
                        <option value="chant" @selected(old('type', $productionAudio->type ?? '') == 'chant')>Chant</option>
                        <option value="podcast" @selected(old('type', $productionAudio->type ?? '') == 'podcast')>Podcast</option>
                        <option value="instrumental" @selected(old('type', $productionAudio->type ?? '') == 'instrumental')>Instrumental</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id"
                        class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $productionAudio->client_studio_id ?? '') == $client->id)>
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
                    <select name="projet_studio_id"
                        class="form-select form-select-lg rounded-4 @error('projet_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($projets as $projet)
                            <option value="{{ $projet->id }}"
                                @selected(old('projet_studio_id', $productionAudio->projet_studio_id ?? '') == $projet->id)>
                                {{ $projet->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('projet_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Workflow studio</div>
                <h5 class="mb-0">Traitement audio</h5>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Statut</label>
                <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                    <option value="enregistrement" @selected(old('statut', $productionAudio->statut ?? 'enregistrement') == 'enregistrement')>Enregistrement</option>
                    <option value="mixage" @selected(old('statut', $productionAudio->statut ?? '') == 'mixage')>Mixage</option>
                    <option value="mastering" @selected(old('statut', $productionAudio->statut ?? '') == 'mastering')>Mastering</option>
                    <option value="livre" @selected(old('statut', $productionAudio->statut ?? '') == 'livre')>Livré</option>
                    <option value="archive" @selected(old('statut', $productionAudio->statut ?? '') == 'archive')>Archivé</option>
                </select>
                @error('statut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label fw-semibold">Durée</label>
                <input type="number"
                    name="duree"
                    class="form-control form-control-lg rounded-4 @error('duree') is-invalid @enderror"
                    value="{{ old('duree', $productionAudio->duree ?? '') }}"
                    placeholder="Ex : 180">
                @error('duree')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Durée indicative de la session ou du fichier, en unité choisie dans ton système.</div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Livrable</div>
                <h5 class="mb-0">Ressource audio</h5>
            </div>

            <label class="form-label fw-semibold">Fichier audio</label>
            <input type="text"
                name="fichier_audio"
                class="form-control form-control-lg rounded-4 @error('fichier_audio') is-invalid @enderror"
                value="{{ old('fichier_audio', $productionAudio->fichier_audio ?? '') }}"
                placeholder="Ex : audios/session-v2.wav">
            @error('fichier_audio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="form-text mt-2">
                Renseigne le nom du fichier, son chemin ou sa référence interne.
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="mb-3">
                <div class="mini-label">Description</div>
                <h5 class="mb-0">Notes de session</h5>
            </div>

            <label class="form-label fw-semibold">Description</label>
            <textarea name="description"
                rows="6"
                class="form-control rounded-4 @error('description') is-invalid @enderror"
                placeholder="Contexte client, style recherché, besoins techniques, consignes de mixage, détails artistiques...">{{ old('description', $productionAudio->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>