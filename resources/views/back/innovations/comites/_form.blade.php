<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-bold">Nom du comité</label>
        <input type="text" name="nom" class="form-control hub-input"
               value="{{ old('nom', $comite->nom ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Type de comité</label>
        <select name="type_comite" class="form-select hub-input" required>
            @foreach(['strategique','technique','validation','suivi'] as $type)
                <option value="{{ $type }}" @selected(old('type_comite', $comite->type_comite ?? 'strategique') === $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['actif','suspendu','archive'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $comite->statut ?? 'actif') === $statut)>
                    {{ ucfirst($statut) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $comite->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.comites.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
    </div>

</div>
