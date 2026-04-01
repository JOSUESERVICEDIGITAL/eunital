<div class="row g-4">
    <div class="col-12">
        <label class="form-label fw-semibold">Nom</label>
        <input type="text" name="nom"
            class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
            value="{{ old('nom', $categorieMedia->nom ?? '') }}">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $categorieMedia->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="est_actif" value="1"
                @checked(old('est_actif', $categorieMedia->est_actif ?? true))>
            <label class="form-check-label">Catégorie active</label>
        </div>
    </div>
</div>