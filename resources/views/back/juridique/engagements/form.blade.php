<div class="form-group">
    <label for="document_id">Document associé <span class="text-danger">*</span></label>
    <select name="document_id" id="document_id" class="form-control" required>
        <option value="">Sélectionner</option>
        @foreach($documents as $doc)
        <option value="{{ $doc->id }}" {{ old('document_id', $engagement->document_id ?? '') == $doc->id ? 'selected' : '' }}>{{ $doc->titre }}</option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_engagement">Type d'engagement</label>
            <select name="type_engagement" id="type_engagement" class="form-control">
                <option value="charte" {{ old('type_engagement', $engagement->type_engagement ?? '') == 'charte' ? 'selected' : '' }}>Charte</option>
                <option value="ethique" {{ old('type_engagement', $engagement->type_engagement ?? '') == 'ethique' ? 'selected' : '' }}>Code d'éthique</option>
                <option value="confidentialite" {{ old('type_engagement', $engagement->type_engagement ?? '') == 'confidentialite' ? 'selected' : '' }}>Confidentialité</option>
                <option value="conformite" {{ old('type_engagement', $engagement->type_engagement ?? '') == 'conformite' ? 'selected' : '' }}>Conformité</option>
                <option value="qualite" {{ old('type_engagement', $engagement->type_engagement ?? '') == 'qualite' ? 'selected' : '' }}>Qualité</option>
                <option value="securite" {{ old('type_engagement', $engagement->type_engagement ?? '') == 'securite' ? 'selected' : '' }}>Sécurité</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="reference">Référence</label>
            <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference', $engagement->reference ?? '') }}" placeholder="Généré auto">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_adhesion">Date d'adhésion</label>
            <input type="date" name="date_adhesion" id="date_adhesion" class="form-control" value="{{ old('date_adhesion', isset($engagement) && $engagement->date_adhesion ? $engagement->date_adhesion->format('Y-m-d') : date('Y-m-d')) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin', isset($engagement) && $engagement->date_fin ? $engagement->date_fin->format('Y-m-d') : '') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" rows="10" class="form-control">{{ old('contenu', $engagement->contenu ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="principes">Principes (JSON)</label>
    <textarea name="principes" id="principes" rows="3" class="form-control font-monospace">{{ old('principes', isset($engagement) && $engagement->principes ? json_encode($engagement->principes, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

<div class="form-group">
    <label for="obligations">Obligations (JSON)</label>
    <textarea name="obligations" id="obligations" rows="3" class="form-control font-monospace">{{ old('obligations', isset($engagement) && $engagement->obligations ? json_encode($engagement->obligations, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

<div class="custom-control custom-switch">
    <input type="checkbox" name="est_public" id="est_public" class="custom-control-input" value="1" {{ old('est_public', $engagement->est_public ?? false) ? 'checked' : '' }}>
    <label class="custom-control-label" for="est_public">Engagement public</label>
</div>