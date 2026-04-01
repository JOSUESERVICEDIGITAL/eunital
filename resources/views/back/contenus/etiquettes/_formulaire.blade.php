<div class="row g-4">
    <div class="col-md-12">
        <label for="nom" class="form-label fw-semibold">Nom de l’étiquette</label>
        <input type="text"
               name="nom"
               id="nom"
               class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
               value="{{ old('nom', $etiquette->nom ?? '') }}"
               placeholder="Ex : IA, Laravel, Sécurité, Design...">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>