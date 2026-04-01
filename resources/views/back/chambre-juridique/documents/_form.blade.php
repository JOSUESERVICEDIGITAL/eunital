<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Titre du document</label>
        <input type="text"
               name="titre"
               class="form-control form-control-lg rounded-4"
               value="{{ old('titre', $document->titre ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Catégorie</label>
        <select name="categorie" class="form-select form-select-lg rounded-4">
            <option value="cgu" @selected(old('categorie', $document->categorie ?? '') == 'cgu')>CGU</option>
            <option value="politique_confidentialite" @selected(old('categorie', $document->categorie ?? '') == 'politique_confidentialite')>Confidentialité</option>
            <option value="charte" @selected(old('categorie', $document->categorie ?? '') == 'charte')>Charte</option>
            <option value="reglement" @selected(old('categorie', $document->categorie ?? '') == 'reglement')>Règlement</option>
            <option value="procedure" @selected(old('categorie', $document->categorie ?? '') == 'procedure')>Procédure</option>
            <option value="convention" @selected(old('categorie', $document->categorie ?? '') == 'convention')>Convention</option>
            <option value="texte_legal" @selected(old('categorie', $document->categorie ?? '') == 'texte_legal')>Texte légal</option>
            <option value="autre" @selected(old('categorie', $document->categorie ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="brouillon" @selected(old('statut', $document->statut ?? 'brouillon') == 'brouillon')>Brouillon</option>
            <option value="actif" @selected(old('statut', $document->statut ?? '') == 'actif')>Actif</option>
            <option value="archive" @selected(old('statut', $document->statut ?? '') == 'archive')>Archivé</option>
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label fw-semibold">Contenu du document</label>
        <textarea name="contenu" rows="12" class="form-control rounded-4">{{ old('contenu', $document->contenu ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Fichier joint</label>
        <input type="file"
               name="fichier"
               class="form-control form-control-lg rounded-4">
    </div>

</div>
