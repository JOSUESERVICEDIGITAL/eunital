<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche design UI/UX</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $design->titre ?? '') }}"
                           placeholder="Ex : Wireframe dashboard, prototype mobile, maquette landing page...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="wireframe" @selected(old('type', $design->type ?? '') == 'wireframe')>Wireframe</option>
                        <option value="maquette" @selected(old('type', $design->type ?? 'maquette') == 'maquette')>Maquette</option>
                        <option value="prototype" @selected(old('type', $design->type ?? '') == 'prototype')>Prototype</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Projet</label>
                    <select name="projet_studio_id" class="form-select form-select-lg rounded-4 @error('projet_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($projets as $projet)
                            <option value="{{ $projet->id }}"
                                @selected(old('projet_studio_id', $design->projet_studio_id ?? '') == $projet->id)>
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
                        <option value="conception" @selected(old('statut', $design->statut ?? 'conception') == 'conception')>Conception</option>
                        <option value="test" @selected(old('statut', $design->statut ?? '') == 'test')>Test</option>
                        <option value="valide" @selected(old('statut', $design->statut ?? '') == 'valide')>Validé</option>
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
                           value="{{ old('fichier', $design->fichier ?? '') }}"
                           placeholder="Ex : uiux/prototype-mobile-v2.fig">
                    @error('fichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>