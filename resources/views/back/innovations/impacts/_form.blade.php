<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Innovation</label>
        <select name="innovation_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $impact->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Type d’impact</label>
        <input type="text" name="type_impact" class="form-control hub-input"
               value="{{ old('type_impact', $impact->type_impact ?? '') }}"
               placeholder="Ex: financier, social, opérationnel, territorial..." required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Période de mesure</label>
        <input type="text" name="periode_mesure" class="form-control hub-input"
               value="{{ old('periode_mesure', $impact->periode_mesure ?? '') }}"
               placeholder="Ex: T1 2026, Janvier 2026..." required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Valeur avant</label>
        <input type="number" step="0.01" name="valeur_avant" class="form-control hub-input"
               value="{{ old('valeur_avant', $impact->valeur_avant ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Valeur après</label>
        <input type="number" step="0.01" name="valeur_apres" class="form-control hub-input"
               value="{{ old('valeur_apres', $impact->valeur_apres ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $impact->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.impacts.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
    </div>

</div>
