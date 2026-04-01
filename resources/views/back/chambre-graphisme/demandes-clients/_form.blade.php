<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche demande client</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $demande->titre ?? '') }}"
                           placeholder="Ex : Création logo, affiches campagne, kit social media...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id" class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $demande->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="logo" @selected(old('type', $demande->type ?? '') == 'logo')>Logo</option>
                        <option value="affiche" @selected(old('type', $demande->type ?? '') == 'affiche')>Affiche</option>
                        <option value="reseaux" @selected(old('type', $demande->type ?? '') == 'reseaux')>Réseaux sociaux</option>
                        <option value="uiux" @selected(old('type', $demande->type ?? '') == 'uiux')>UI / UX</option>
                        <option value="branding" @selected(old('type', $demande->type ?? '') == 'branding')>Branding</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Priorité</label>
                    <select name="priorite" class="form-select form-select-lg rounded-4 @error('priorite') is-invalid @enderror">
                        <option value="faible" @selected(old('priorite', $demande->priorite ?? '') == 'faible')>Faible</option>
                        <option value="normale" @selected(old('priorite', $demande->priorite ?? 'normale') == 'normale')>Normale</option>
                        <option value="urgente" @selected(old('priorite', $demande->priorite ?? '') == 'urgente')>Urgente</option>
                    </select>
                    @error('priorite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="en_attente" @selected(old('statut', $demande->statut ?? 'en_attente') == 'en_attente')>En attente</option>
                        <option value="en_cours" @selected(old('statut', $demande->statut ?? '') == 'en_cours')>En cours</option>
                        <option value="termine" @selected(old('statut', $demande->statut ?? '') == 'termine')>Terminée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description"
                              rows="6"
                              class="form-control rounded-4 @error('description') is-invalid @enderror"
                              placeholder="Décris ici le brief, les attentes du client, les formats souhaités, les délais et les références...">{{ old('description', $demande->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>
