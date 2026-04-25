<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre', $idee->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Catégorie</label>
        <input type="text" name="categorie" class="form-control hub-input"
               value="{{ old('categorie', $idee->categorie ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Origine</label>
        <select name="origine" class="form-select hub-input" required>
            @foreach(['interne','citoyen','partenaire','institution'] as $o)
                <option value="{{ $o }}" @selected(old('origine', $idee->origine ?? 'interne') === $o)>
                    {{ ucfirst($o) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Maturité</label>
        <select name="niveau_maturite" class="form-select hub-input" required>
            @foreach(['idee','concept','prototype','pret'] as $m)
                <option value="{{ $m }}" @selected(old('niveau_maturite', $idee->niveau_maturite ?? 'idee') === $m)>
                    {{ ucfirst($m) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Impact potentiel</label>
        <select name="impact_potentiel" class="form-select hub-input" required>
            @foreach(['faible','moyen','fort','majeur'] as $i)
                <option value="{{ $i }}" @selected(old('impact_potentiel', $idee->impact_potentiel ?? 'moyen') === $i)>
                    {{ ucfirst($i) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Faisabilité</label>
        <select name="faisabilite" class="form-select hub-input" required>
            @foreach(['faible','moyenne','haute'] as $f)
                <option value="{{ $f }}" @selected(old('faisabilite', $idee->faisabilite ?? 'moyenne') === $f)>
                    {{ ucfirst($f) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['soumise','en_etude','retenue','rejetee','transformee_en_innovation'] as $s)
                <option value="{{ $s }}" @selected(old('statut', $idee->statut ?? 'soumise') === $s)>
                    {{ ucfirst(str_replace('_',' ',$s)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Auteur</label>
        <select name="auteur_id" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('auteur_id', $idee->auteur_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="anonyme" value="0">
            <input class="form-check-input" type="checkbox" name="anonyme" value="1"
                   @checked(old('anonyme', $idee->anonyme ?? false))>
            <label class="form-check-label fw-bold">Idée anonyme</label>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Tags</label>
        <select name="tags[]" class="form-select rounded-4" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                    @selected(isset($idee) && $idee && $idee->tags->contains($tag->id))>
                    {{ $tag->nom }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Maintiens Ctrl pour sélectionner plusieurs tags.</small>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4" required>{{ old('description', $idee->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.idees.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
    </div>

</div>
