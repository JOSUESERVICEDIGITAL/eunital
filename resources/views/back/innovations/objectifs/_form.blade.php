<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Innovation</label>
        <select name="innovation_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $objectif->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Titre de l’objectif</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre', $objectif->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Valeur cible</label>
        <input type="text" name="valeur_cible" class="form-control hub-input"
               value="{{ old('valeur_cible', $objectif->valeur_cible ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Valeur actuelle</label>
        <input type="text" name="valeur_actuelle" class="form-control hub-input"
               value="{{ old('valeur_actuelle', $objectif->valeur_actuelle ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['non_demarre','en_cours','atteint','non_atteint'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $objectif->statut ?? 'non_demarre') === $statut)>
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $objectif->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.objectifs.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>

</div>
