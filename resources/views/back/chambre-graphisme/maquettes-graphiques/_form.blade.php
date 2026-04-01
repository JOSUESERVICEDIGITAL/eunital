<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche maquette graphique</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $maquette->titre ?? '') }}"
                           placeholder="Ex : Mockup t-shirt, packaging produit, carte de visite...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="creation" @selected(old('statut', $maquette->statut ?? 'creation') == 'creation')>Création</option>
                        <option value="validation" @selected(old('statut', $maquette->statut ?? '') == 'validation')>Validation</option>
                        <option value="livre" @selected(old('statut', $maquette->statut ?? '') == 'livre')>Livrée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Support</label>
                    <input type="text"
                           name="support"
                           class="form-control form-control-lg rounded-4 @error('support') is-invalid @enderror"
                           value="{{ old('support', $maquette->support ?? '') }}"
                           placeholder="Ex : T-shirt, packaging, panneau, carte...">
                    @error('support')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fichier</label>
                    <input type="text"
                           name="fichier"
                           class="form-control form-control-lg rounded-4 @error('fichier') is-invalid @enderror"
                           value="{{ old('fichier', $maquette->fichier ?? '') }}"
                           placeholder="Ex : mockups/tshirt-noir-v2.psd">
                    @error('fichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>