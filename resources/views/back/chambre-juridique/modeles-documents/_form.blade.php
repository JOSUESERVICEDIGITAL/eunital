<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nom du modèle</label>
        <input type="text"
               name="nom"
               class="form-control form-control-lg rounded-4"
               value="{{ old('nom', $modele->nom ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Type de document</label>
        <select name="type_document" class="form-select form-select-lg rounded-4">
            <option value="contrat" @selected(old('type_document', $modele->type_document ?? '') == 'contrat')>Contrat</option>
            <option value="engagement" @selected(old('type_document', $modele->type_document ?? '') == 'engagement')>Engagement</option>
            <option value="convention" @selected(old('type_document', $modele->type_document ?? '') == 'convention')>Convention</option>
            <option value="attestation" @selected(old('type_document', $modele->type_document ?? '') == 'attestation')>Attestation</option>
            <option value="facture_annexe" @selected(old('type_document', $modele->type_document ?? '') == 'facture_annexe')>Facture annexe</option>
            <option value="accord_confidentialite" @selected(old('type_document', $modele->type_document ?? '') == 'accord_confidentialite')>Confidentialité</option>
            <option value="autre" @selected(old('type_document', $modele->type_document ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Version</label>
        <input type="text"
               name="version"
               class="form-control form-control-lg rounded-4"
               value="{{ old('version', $modele->version ?? '') }}">
    </div>

    <div class="col-md-12">
        <label class="form-label fw-semibold">Contenu du modèle</label>
        <textarea name="contenu" rows="12" class="form-control rounded-4">{{ old('contenu', $modele->contenu ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="actif" value="1"
                   id="actifModele"
                   @checked(old('actif', $modele->actif ?? true))>
            <label class="form-check-label fw-semibold" for="actifModele">
                Modèle actif
            </label>
        </div>
    </div>

</div>
