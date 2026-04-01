<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche identité visuelle</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nom</label>
                    <input type="text"
                           name="nom"
                           class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $identite->nom ?? '') }}"
                           placeholder="Ex : Identité de marque, charte campagne, branding institutionnel...">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="creation" @selected(old('statut', $identite->statut ?? 'creation') == 'creation')>Création</option>
                        <option value="validation" @selected(old('statut', $identite->statut ?? '') == 'validation')>Validation</option>
                        <option value="termine" @selected(old('statut', $identite->statut ?? '') == 'termine')>Terminée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id" class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $identite->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Logo</label>
                    <input type="text"
                           name="logo"
                           class="form-control form-control-lg rounded-4 @error('logo') is-invalid @enderror"
                           value="{{ old('logo', $identite->logo ?? '') }}"
                           placeholder="Ex : branding/logo-principal.svg">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Palette de couleurs</label>
                    <input type="text"
                           name="palette_couleurs"
                           class="form-control form-control-lg rounded-4 @error('palette_couleurs') is-invalid @enderror"
                           value="{{ old('palette_couleurs', $identite->palette_couleurs ?? '') }}"
                           placeholder="Ex : Bleu, Noir, Blanc / #0ea5e9 #111827 #f8fafc">
                    @error('palette_couleurs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Typographie</label>
                    <input type="text"
                           name="typographie"
                           class="form-control form-control-lg rounded-4 @error('typographie') is-invalid @enderror"
                           value="{{ old('typographie', $identite->typographie ?? '') }}"
                           placeholder="Ex : Inter / Montserrat / Poppins">
                    @error('typographie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description"
                              rows="5"
                              class="form-control rounded-4 @error('description') is-invalid @enderror"
                              placeholder="Décris ici les choix graphiques, les objectifs de marque, les références et les contraintes...">{{ old('description', $identite->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>