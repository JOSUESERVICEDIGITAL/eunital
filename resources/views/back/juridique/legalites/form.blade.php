<div class="form-group"><label for="titre">Titre *</label><input type="text" name="titre" id="titre"
        class="form-control" value="{{ old('titre', $legalite->titre ?? '') }}" required></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="type">Type</label><select name="type" id="type"
                class="form-control">
                <option value="loi">Loi</option>
                <option value="decret">Décret</option>
                <option value="arrete">Arrêté</option>
                <option value="circulaire">Circulaire</option>
                <option value="reglement">Règlement</option>
                <option value="norme">Norme</option>
            </select></div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="reference">Référence</label><input type="text" name="reference"
                id="reference" class="form-control" value="{{ old('reference', $legalite->reference ?? '') }}"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="date_publication">Date publication</label><input type="date"
                name="date_publication" id="date_publication" class="form-control"
                value="{{ old('date_publication', isset($legalite) && $legalite->date_publication ? $legalite->date_publication->format('Y-m-d') : '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="date_application">Date application</label><input type="date"
                name="date_application" id="date_application" class="form-control"
                value="{{ old('date_application', isset($legalite) && $legalite->date_application ? $legalite->date_application->format('Y-m-d') : '') }}">
        </div>
    </div>
</div>
<div class="form-group"><label for="resume">Résumé *</label>
    <textarea name="resume" id="resume" rows="3" class="form-control" required>{{ old('resume', $legalite->resume ?? '') }}</textarea>
</div>
<div class="form-group"><label for="contenu_complet">Contenu complet</label>
    <textarea name="contenu_complet" id="contenu_complet" rows="10" class="form-control">{{ old('contenu_complet', $legalite->contenu_complet ?? '') }}</textarea>
</div>
<div class="custom-control custom-switch"><input type="checkbox" name="est_en_vigueur" id="est_en_vigueur"
        class="custom-control-input" value="1"
        {{ old('est_en_vigueur', $legalite->est_en_vigueur ?? true) ? 'checked' : '' }}><label
        class="custom-control-label" for="est_en_vigueur">En vigueur</label>
</div>
