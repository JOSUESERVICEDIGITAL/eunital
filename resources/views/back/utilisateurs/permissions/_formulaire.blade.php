<div class="row g-4">
    <div class="col-md-6">
        <label for="nom" class="form-label fw-semibold">Nom de la permission</label>
        <input type="text" name="nom" id="nom"
            class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
            value="{{ old('nom', $permission->nom ?? '') }}"
            placeholder="Ex : gérer les utilisateurs">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="groupe" class="form-label fw-semibold">Groupe</label>
        <input type="text" name="groupe" id="groupe"
            class="form-control form-control-lg rounded-4 @error('groupe') is-invalid @enderror"
            value="{{ old('groupe', $permission->groupe ?? '') }}"
            placeholder="Ex : utilisateurs, contenus, paiements">
        @error('groupe')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="description" class="form-label fw-semibold">Description</label>
        <textarea name="description" id="description" rows="5"
            class="form-control rounded-4 @error('description') is-invalid @enderror"
            placeholder="Décris cette permission...">{{ old('description', $permission->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
