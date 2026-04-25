<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Innovation</label>
        <select name="innovation_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $indicateur->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Nom de l’indicateur</label>
        <input type="text" name="nom" class="form-control hub-input"
               value="{{ old('nom', $indicateur->nom ?? '') }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Unité</label>
        <input type="text" name="unite" class="form-control hub-input"
               value="{{ old('unite', $indicateur->unite ?? '') }}"
               placeholder="%, nombre, FCFA, jours...">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Valeur référence</label>
        <input type="number" step="0.01" name="valeur_reference" class="form-control hub-input"
               value="{{ old('valeur_reference', $indicateur->valeur_reference ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Valeur cible</label>
        <input type="number" step="0.01" name="valeur_cible" class="form-control hub-input"
               value="{{ old('valeur_cible', $indicateur->valeur_cible ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Valeur actuelle</label>
        <input type="number" step="0.01" name="valeur_actuelle" class="form-control hub-input"
               value="{{ old('valeur_actuelle', $indicateur->valeur_actuelle ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $indicateur->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.indicateurs.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>

</div>
