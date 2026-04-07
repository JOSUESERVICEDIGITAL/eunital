<div class="form-group">
    <label for="titre">Titre <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre', $document->titre ?? '') }}" required>
    @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_document_id">Type de document <span class="text-danger">*</span></label>
            <select name="type_document_id" id="type_document_id" class="form-control @error('type_document_id') is-invalid @enderror" required>
                <option value="">Sélectionner</option>
                @foreach($typesDocuments as $type)
                <option value="{{ $type->id }}" {{ old('type_document_id', $document->type_document_id ?? '') == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                @endforeach
            </select>
            @error('type_document_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="modele_document_id">Modèle</label>
            <select name="modele_document_id" id="modele_document_id" class="form-control @error('modele_document_id') is-invalid @enderror">
                <option value="">Aucun modèle</option>
                @foreach($modelesDocuments as $modele)
                <option value="{{ $modele->id }}" {{ old('modele_document_id', $document->modele_document_id ?? '') == $modele->id ? 'selected' : '' }}>{{ $modele->titre }} (v{{ $modele->version }})</option>
                @endforeach
            </select>
            @error('modele_document_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $document->description ?? '') }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="date_effet">Date d'effet</label>
            <input type="date" name="date_effet" id="date_effet" class="form-control @error('date_effet') is-invalid @enderror" value="{{ old('date_effet', isset($document) && $document->date_effet ? $document->date_effet->format('Y-m-d') : '') }}">
            @error('date_effet')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="date_expiration">Date d'expiration</label>
            <input type="date" name="date_expiration" id="date_expiration" class="form-control @error('date_expiration') is-invalid @enderror" value="{{ old('date_expiration', isset($document) && $document->date_expiration ? $document->date_expiration->format('Y-m-d') : '') }}">
            @error('date_expiration')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control @error('statut') is-invalid @enderror">
                <option value="brouillon" {{ old('statut', $document->statut ?? 'brouillon') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                <option value="en_attente" {{ old('statut', $document->statut ?? '') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="valide" {{ old('statut', $document->statut ?? '') == 'valide' ? 'selected' : '' }}>Validé</option>
            </select>
            @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="fichier">Fichier PDF (optionnel)</label>
    <input type="file" name="fichier" id="fichier" class="form-control-file @error('fichier') is-invalid @enderror" accept=".pdf">
    @if(isset($document) && $document->fichier_path)<small class="text-muted">Fichier actuel : {{ basename($document->fichier_path) }}</small>@endif
    @error('fichier')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="utilisateurs">Utilisateurs associés</label>
            <select name="utilisateurs[]" id="utilisateurs" class="form-control select2" multiple>
                @foreach($utilisateurs as $user)
                <option value="{{ $user->id }}" {{ isset($utilisateursAssocies) && in_array($user->id, $utilisateursAssocies) ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="entreprises">Entreprises associées</label>
            <select name="entreprises[]" id="entreprises" class="form-control select2" multiple>
                @foreach($entreprises as $entreprise)
                <option value="{{ $entreprise->id }}" {{ isset($entreprisesAssociees) && in_array($entreprise->id, $entreprisesAssociees) ? 'selected' : '' }}>{{ $entreprise->nom }} ({{ $entreprise->siret_formate ?? $entreprise->siret }})</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@push('juridique-scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#utilisateurs, #entreprises').select2({ theme: 'bootstrap4', placeholder: 'Sélectionner...', allowClear: true });
    $('#type_document_id').on('change', function() { if($('#modele_document_id').val() === '') { $('#modele_document_id').val(''); } });
</script>
@endpush
