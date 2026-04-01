<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Nom de marque</label>
        <input type="text" name="nom_marque"
               class="form-control form-control-lg rounded-4 @error('nom_marque') is-invalid @enderror"
               value="{{ old('nom_marque', $imageMarque->nom_marque ?? '') }}">
        @error('nom_marque')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="brouillon" @selected(old('statut', $imageMarque->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="active" @selected(old('statut', $imageMarque->statut ?? '') === 'active')>Active</option>
            <option value="obsolete" @selected(old('statut', $imageMarque->statut ?? '') === 'obsolete')>Obsolète</option>
            <option value="archivee" @selected(old('statut', $imageMarque->statut ?? '') === 'archivee')>Archivée</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}"
                    @selected(old('auteur_id', $imageMarque->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Slogan</label>
        <input type="text" name="slogan"
               class="form-control form-control-lg rounded-4"
               value="{{ old('slogan', $imageMarque->slogan ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Ton de marque</label>
        <input type="text" name="ton_marque"
               class="form-control form-control-lg rounded-4"
               value="{{ old('ton_marque', $imageMarque->ton_marque ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Logo</label>
        <input type="text" name="logo"
               class="form-control form-control-lg rounded-4"
               value="{{ old('logo', $imageMarque->logo ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Identité visuelle</label>
        <textarea name="identite_visuelle" rows="4" class="form-control rounded-4">{{ old('identite_visuelle', $imageMarque->identite_visuelle ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Palette couleurs</label>
        <textarea name="palette_couleurs" rows="4" class="form-control rounded-4">{{ old('palette_couleurs', $imageMarque->palette_couleurs ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Éléments de langage</label>
        <textarea name="elements_langage" rows="4" class="form-control rounded-4">{{ old('elements_langage', $imageMarque->elements_langage ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Ligne éditoriale</label>
        <textarea name="ligne_editoriale" rows="4" class="form-control rounded-4">{{ old('ligne_editoriale', $imageMarque->ligne_editoriale ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Charte graphique</label>
        <input type="text" name="charte_graphique"
               class="form-control form-control-lg rounded-4"
               value="{{ old('charte_graphique', $imageMarque->charte_graphique ?? '') }}">
    </div>
</div>