<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Département</label>
        <select name="departement_id" class="form-select form-select-lg rounded-4 @error('departement_id') is-invalid @enderror">
            <option value="">Choisir un département</option>
            @foreach($departements as $departement)
                <option value="{{ $departement->id }}"
                    @selected(old('departement_id', $poste->departement_id ?? '') == $departement->id)>
                    {{ $departement->nom }}
                </option>
            @endforeach
        </select>
        @error('departement_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nom du poste</label>
        <input type="text"
               name="nom"
               class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
               value="{{ old('nom', $poste->nom ?? '') }}"
               placeholder="Ex : Responsable communication">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description"
                  rows="5"
                  class="form-control rounded-4 @error('description') is-invalid @enderror"
                  placeholder="Décris le rôle et les responsabilités du poste...">{{ old('description', $poste->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input"
                   type="checkbox"
                   role="switch"
                   name="est_actif"
                   value="1"
                   @checked(old('est_actif', $poste->est_actif ?? true))>
            <label class="form-check-label">Poste actif</label>
        </div>
    </div>
</div>