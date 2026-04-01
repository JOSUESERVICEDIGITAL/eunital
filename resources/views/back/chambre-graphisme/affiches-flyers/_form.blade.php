<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche affiche / flyer</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $affiche->titre ?? '') }}"
                           placeholder="Ex : Affiche événement, flyer campagne, support promotionnel...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="affiche" @selected(old('type', $affiche->type ?? 'affiche') == 'affiche')>Affiche</option>
                        <option value="flyer" @selected(old('type', $affiche->type ?? '') == 'flyer')>Flyer</option>
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
                                @selected(old('client_studio_id', $affiche->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="creation" @selected(old('statut', $affiche->statut ?? 'creation') == 'creation')>Création</option>
                        <option value="validation" @selected(old('statut', $affiche->statut ?? '') == 'validation')>Validation</option>
                        <option value="livre" @selected(old('statut', $affiche->statut ?? '') == 'livre')>Livré</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Fichier</label>
                    <input type="text"
                           name="fichier"
                           class="form-control form-control-lg rounded-4 @error('fichier') is-invalid @enderror"
                           value="{{ old('fichier', $affiche->fichier ?? '') }}"
                           placeholder="Ex : supports/affiche-evenement-v2.jpg">
                    @error('fichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description"
                              rows="5"
                              class="form-control rounded-4 @error('description') is-invalid @enderror"
                              placeholder="Décris ici le support, son objectif, son format, sa cible et ses contraintes...">{{ old('description', $affiche->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>