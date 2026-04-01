<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche client studio</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nom du client</label>
                    <input type="text"
                           name="nom"
                           class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $clientStudio->nom ?? '') }}"
                           placeholder="Ex : Ruth Production, Daniel Artist, Société X">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        <option value="artiste" @selected(old('type', $clientStudio->type ?? '') == 'artiste')>Artiste</option>
                        <option value="entreprise" @selected(old('type', $clientStudio->type ?? '') == 'entreprise')>Entreprise</option>
                        <option value="particulier" @selected(old('type', $clientStudio->type ?? '') == 'particulier')>Particulier</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Téléphone</label>
                    <input type="text"
                           name="telephone"
                           class="form-control form-control-lg rounded-4 @error('telephone') is-invalid @enderror"
                           value="{{ old('telephone', $clientStudio->telephone ?? '') }}"
                           placeholder="Ex : +212 6 00 00 00 00">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control form-control-lg rounded-4 @error('email') is-invalid @enderror"
                           value="{{ old('email', $clientStudio->email ?? '') }}"
                           placeholder="Ex : client@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Adresse</label>
                    <textarea name="adresse"
                              rows="4"
                              class="form-control rounded-4 @error('adresse') is-invalid @enderror"
                              placeholder="Adresse complète, quartier, ville, indications utiles...">{{ old('adresse', $clientStudio->adresse ?? '') }}</textarea>
                    @error('adresse')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>