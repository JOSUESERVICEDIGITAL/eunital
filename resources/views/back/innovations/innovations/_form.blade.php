<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="titre" class="form-control hub-input" value="{{ old('titre', $innovation->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Portefeuille</label>
        <select name="innovation_portefeuille_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($portefeuilles as $portefeuille)
                <option value="{{ $portefeuille->id }}" @selected(old('innovation_portefeuille_id', $innovation->innovation_portefeuille_id ?? '') == $portefeuille->id)>
                    {{ $portefeuille->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Type</label>
        <select name="type_innovation" class="form-select hub-input" required>
            @foreach(['digitale','organisationnelle','sociale','territoriale','technique'] as $type)
                <option value="{{ $type }}" @selected(old('type_innovation', $innovation->type_innovation ?? '') === $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Maturité</label>
        <select name="niveau_maturite" class="form-select hub-input" required>
            @foreach(['idee','etude','prototype','pilote','deploiement','industrialisee'] as $niveau)
                <option value="{{ $niveau }}" @selected(old('niveau_maturite', $innovation->niveau_maturite ?? '') === $niveau)>
                    {{ ucfirst($niveau) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Portée</label>
        <select name="portee_geographique" class="form-select hub-input" required>
            @foreach(['locale','communale','provinciale','regionale','nationale'] as $portee)
                <option value="{{ $portee }}" @selected(old('portee_geographique', $innovation->portee_geographique ?? '') === $portee)>
                    {{ ucfirst($portee) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Responsable</label>
        <select name="responsable_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('responsable_id', $innovation->responsable_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Sponsor</label>
        <select name="sponsor_id" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('sponsor_id', $innovation->sponsor_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Priorité</label>
        <select name="niveau_priorite" class="form-select hub-input" required>
            @foreach(['faible','moyenne','haute','critique'] as $priorite)
                <option value="{{ $priorite }}" @selected(old('niveau_priorite', $innovation->niveau_priorite ?? 'moyenne') === $priorite)>
                    {{ ucfirst($priorite) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['brouillon','en_etude','en_cours','en_pilote','deployee','suspendue','terminee','archivee'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $innovation->statut ?? 'brouillon') === $statut)>
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date lancement</label>
        <input type="date" name="date_lancement" class="form-control hub-input"
               value="{{ old('date_lancement', optional($innovation->date_lancement ?? null)->format('Y-m-d')) }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Fin prévisionnelle</label>
        <input type="date" name="date_fin_previsionnelle" class="form-control hub-input"
               value="{{ old('date_fin_previsionnelle', optional($innovation->date_fin_previsionnelle ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Budget prévisionnel</label>
        <input type="number" step="0.01" name="budget_previsionnel" class="form-control hub-input"
               value="{{ old('budget_previsionnel', $innovation->budget_previsionnel ?? 0) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Budget consommé</label>
        <input type="number" step="0.01" name="budget_consomme" class="form-control hub-input"
               value="{{ old('budget_consomme', $innovation->budget_consomme ?? 0) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Secteur</label>
        <input type="text" name="secteur" class="form-control hub-input" value="{{ old('secteur', $innovation->secteur ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $innovation->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2 mt-3">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.innovations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>
</div>
