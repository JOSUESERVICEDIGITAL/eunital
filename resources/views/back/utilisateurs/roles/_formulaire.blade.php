<div class="row g-4">
    <div class="col-md-12">
        <label for="nom" class="form-label fw-semibold">Nom du rôle</label>
        <input type="text" name="nom" id="nom"
            class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
            value="{{ old('nom', $role->nom ?? '') }}"
            placeholder="Ex : Administrateur, Auteur, Responsable">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="description" class="form-label fw-semibold">Description</label>
        <textarea name="description" id="description" rows="5"
            class="form-control rounded-4 @error('description') is-invalid @enderror"
            placeholder="Décris la responsabilité de ce rôle...">{{ old('description', $role->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" id="est_actif"
                name="est_actif" value="1"
                @checked(old('est_actif', $role->est_actif ?? true))>
            <label class="form-check-label" for="est_actif">Rôle actif</label>
        </div>
    </div>
</div>
