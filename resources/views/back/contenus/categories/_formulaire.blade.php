<div class="row g-4">
    <div class="col-md-12">
        <label for="nom" class="form-label fw-semibold">Nom de la catégorie</label>
        <input type="text"
               name="nom"
               id="nom"
               class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
               value="{{ old('nom', $categorie->nom ?? '') }}"
               placeholder="Ex : Technologie, Marketing, Médias...">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="description" class="form-label fw-semibold">Description</label>
        <textarea name="description"
                  id="description"
                  rows="5"
                  class="form-control rounded-4 @error('description') is-invalid @enderror"
                  placeholder="Décris brièvement cette catégorie...">{{ old('description', $categorie->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="categorie_parente_id" class="form-label fw-semibold">Catégorie parente</label>
        <select name="categorie_parente_id"
                id="categorie_parente_id"
                class="form-select form-select-lg rounded-4 @error('categorie_parente_id') is-invalid @enderror">
            <option value="">Aucune catégorie parente</option>
            @foreach($categoriesParentes as $categorieParente)
                <option value="{{ $categorieParente->id }}"
                    @selected(old('categorie_parente_id', $categorie->categorie_parente_id ?? '') == $categorieParente->id)>
                    {{ $categorieParente->nom }}
                </option>
            @endforeach
        </select>
        @error('categorie_parente_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold d-block">Statut</label>
        <div class="form-check form-switch mt-3">
            <input class="form-check-input"
                   type="checkbox"
                   role="switch"
                   id="est_active"
                   name="est_active"
                   value="1"
                   @checked(old('est_active', $categorie->est_active ?? true))>
            <label class="form-check-label" for="est_active">Catégorie active</label>
        </div>
    </div>
</div>