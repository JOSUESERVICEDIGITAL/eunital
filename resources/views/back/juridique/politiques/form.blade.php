<div class="form-group"><label for="titre">Titre *</label><input type="text" name="titre" id="titre"
        class="form-control" value="{{ old('titre', $politiqueConfidentialite->titre ?? '') }}" required></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="version">Version</label><input type="text" name="version" id="version"
                class="form-control" value="{{ old('version', $politiqueConfidentialite->version ?? '1.0') }}"></div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="duree_conservation">Durée de conservation (jours)</label><input
                type="number" name="duree_conservation" id="duree_conservation" class="form-control"
                value="{{ old('duree_conservation', $politiqueConfidentialite->duree_conservation ?? '') }}"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group"><label for="date_effet">Date d'effet</label><input type="date" name="date_effet"
                id="date_effet" class="form-control"
                value="{{ old('date_effet', isset($politiqueConfidentialite) && $politiqueConfidentialite->date_effet ? $politiqueConfidentialite->date_effet->format('Y-m-d') : date('Y-m-d')) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"><label for="date_fin">Date de fin</label><input type="date" name="date_fin"
                id="date_fin" class="form-control"
                value="{{ old('date_fin', isset($politiqueConfidentialite) && $politiqueConfidentialite->date_fin ? $politiqueConfidentialite->date_fin->format('Y-m-d') : '') }}">
        </div>
    </div>
</div>
<div class="form-group"><label for="contenu">Contenu *</label>
    <textarea name="contenu" id="contenu" rows="15" class="form-control" required>{{ old('contenu', $politiqueConfidentialite->contenu ?? '') }}</textarea>
</div>
<div class="custom-control custom-switch"><input type="checkbox" name="is_active" id="is_active"
        class="custom-control-input" value="1"
        {{ old('is_active', $politiqueConfidentialite->is_active ?? true) ? 'checked' : '' }}><label
        class="custom-control-label" for="is_active">Active</label></div>
