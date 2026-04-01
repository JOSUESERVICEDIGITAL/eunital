<div class="row g-4">
    <div class="col-md-12">
        <label class="form-label fw-semibold">Nom du département</label>
        <input type="text" name="nom" class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
            value="{{ old('nom', $departement->nom ?? '') }}">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5" class="form-control rounded-4">{{ old('description', $departement->description ?? '') }}</textarea>
    </div>

    <div class="col-md-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="est_actif" value="1"
                @checked(old('est_actif', $departement->est_actif ?? true))>
            <label class="form-check-label">Département actif</label>
        </div>
    </div>
</div>