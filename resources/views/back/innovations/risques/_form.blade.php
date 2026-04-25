<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Réforme liée</label>
        <select name="reforme_interne_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($reformes as $reforme)
                <option value="{{ $reforme->id }}" @selected(old('reforme_interne_id', $risque->reforme_interne_id ?? '') == $reforme->id)>
                    {{ $reforme->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Niveau</label>
        <select name="niveau" class="form-select hub-input" required>
            @foreach(['faible','moyen','eleve','critique'] as $niveau)
                <option value="{{ $niveau }}" @selected(old('niveau', $risque->niveau ?? 'moyen') === $niveau)>
                    {{ ucfirst($niveau) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Titre du risque</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre', $risque->titre ?? '') }}" required>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="5" class="form-control rounded-4">{{ old('description', $risque->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Mesure de mitigation</label>
        <textarea name="mesure_mitigation" rows="5" class="form-control rounded-4">{{ old('mesure_mitigation', $risque->mesure_mitigation ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.risques.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>

</div>
