<div class="row g-4">

    <div class="col-md-4">
        <label class="form-label fw-bold">Code</label>
        <input type="text" name="code" class="form-control hub-input"
               value="{{ old('code', $portefeuille->code ?? '') }}"
               placeholder="Automatique si vide">
    </div>

    <div class="col-md-8">
        <label class="form-label fw-bold">Nom du portefeuille</label>
        <input type="text" name="nom" class="form-control hub-input"
               value="{{ old('nom', $portefeuille->nom ?? '') }}"
               required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Type</label>
        <select name="type_portefeuille" class="form-select hub-input" required>
            @foreach(['national','ministeriel','regional','sectoriel'] as $type)
                <option value="{{ $type }}" @selected(old('type_portefeuille', $portefeuille->type_portefeuille ?? 'national') === $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['actif','suspendu','archive'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $portefeuille->statut ?? 'actif') === $statut)>
                    {{ ucfirst($statut) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Priorité</label>
        <select name="niveau_priorite" class="form-select hub-input" required>
            @foreach(['faible','moyenne','haute','critique'] as $priorite)
                <option value="{{ $priorite }}" @selected(old('niveau_priorite', $portefeuille->niveau_priorite ?? 'moyenne') === $priorite)>
                    {{ ucfirst($priorite) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Responsable</label>
        <select name="responsable_id" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($responsables as $responsable)
                <option value="{{ $responsable->id }}" @selected(old('responsable_id', $portefeuille->responsable_id ?? '') == $responsable->id)>
                    {{ $responsable->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date lancement</label>
        <input type="date" name="date_lancement" class="form-control hub-input"
               value="{{ old('date_lancement', optional($portefeuille->date_lancement ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Fin prévisionnelle</label>
        <input type="date" name="date_fin_previsionnelle" class="form-control hub-input"
               value="{{ old('date_fin_previsionnelle', optional($portefeuille->date_fin_previsionnelle ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Budget prévisionnel</label>
        <input type="number" step="0.01" name="budget_previsionnel" class="form-control hub-input"
               value="{{ old('budget_previsionnel', $portefeuille->budget_previsionnel ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Budget consommé</label>
        <input type="number" step="0.01" name="budget_consomme" class="form-control hub-input"
               value="{{ old('budget_consomme', $portefeuille->budget_consomme ?? 0) }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $portefeuille->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2 mt-3">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.portefeuilles.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>
</div>
