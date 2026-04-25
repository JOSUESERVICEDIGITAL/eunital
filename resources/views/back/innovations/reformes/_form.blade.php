<div class="row g-4">

    <div class="col-md-4">
        <label class="form-label fw-bold">Code</label>
        <input type="text" name="code" class="form-control hub-input"
               value="{{ old('code', $reforme->code ?? '') }}"
               placeholder="Automatique si vide">
    </div>

    <div class="col-md-8">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre', $reforme->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Domaine</label>
        <input type="text" name="domaine" class="form-control hub-input"
               value="{{ old('domaine', $reforme->domaine ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Responsable</label>
        <select name="responsable_id" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('responsable_id', $reforme->responsable_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Priorité</label>
        <select name="niveau_priorite" class="form-select hub-input" required>
            @foreach(['faible','moyenne','haute','critique'] as $p)
                <option value="{{ $p }}" @selected(old('niveau_priorite', $reforme->niveau_priorite ?? 'moyenne') === $p)>
                    {{ ucfirst($p) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['brouillon','planifiee','en_cours','suspendue','terminee','archivee'] as $s)
                <option value="{{ $s }}" @selected(old('statut', $reforme->statut ?? 'brouillon') === $s)>
                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date début</label>
        <input type="date" name="date_debut" class="form-control hub-input"
               value="{{ old('date_debut', optional($reforme->date_debut ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Fin prévisionnelle</label>
        <input type="date" name="date_fin_previsionnelle" class="form-control hub-input"
               value="{{ old('date_fin_previsionnelle', optional($reforme->date_fin_previsionnelle ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Objectif</label>
        <textarea name="objectif" rows="4" class="form-control rounded-4">{{ old('objectif', $reforme->objectif ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $reforme->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.reformes.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
    </div>

</div>
