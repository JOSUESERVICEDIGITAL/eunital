<div class="form-group">
    <label for="titre">Titre <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre', $modeleDocument->titre ?? '') }}" required>
    @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_document_id">Type de document <span class="text-danger">*</span></label>
            <select name="type_document_id" id="type_document_id" class="form-control @error('type_document_id') is-invalid @enderror" required>
                <option value="">Sélectionner</option>
                @foreach($typesDocuments as $type)
                <option value="{{ $type->id }}" {{ old('type_document_id', $modeleDocument->type_document_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->nom }} ({{ $type->code }})
                </option>
                @endforeach
            </select>
            @error('type_document_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="version">Version</label>
            <input type="text" name="version" id="version" class="form-control @error('version') is-invalid @enderror" value="{{ old('version', $modeleDocument->version ?? '1.0') }}">
            @error('version')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description', $modeleDocument->description ?? '') }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="variables">Variables (JSON)</label>
            <textarea name="variables" id="variables" rows="4" class="form-control font-monospace @error('variables') is-invalid @enderror" placeholder='["nom_client", "date", "montant"]'>{{ old('variables', isset($modeleDocument) && $modeleDocument->variables ? json_encode($modeleDocument->variables, JSON_PRETTY_PRINT) : '') }}</textarea>
            <small class="text-muted">Liste des variables utilisables dans le template</small>
            @error('variables')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="champs_requis">Champs requis (JSON)</label>
            <textarea name="champs_requis" id="champs_requis" rows="4" class="form-control font-monospace @error('champs_requis') is-invalid @enderror" placeholder='["nom_client", "date"]'>{{ old('champs_requis', isset($modeleDocument) && $modeleDocument->champs_requis ? json_encode($modeleDocument->champs_requis, JSON_PRETTY_PRINT) : '') }}</textarea>
            <small class="text-muted">Variables obligatoires pour la génération</small>
            @error('champs_requis')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="contenu_html">Contenu HTML <span class="text-danger">*</span></label>
            <textarea name="contenu_html" id="contenu_html" rows="15" class="form-control font-monospace @error('contenu_html') is-invalid @enderror" required>{{ old('contenu_html', $modeleDocument->contenu_html ?? '') }}</textarea>
            <small class="text-muted">Utilisez {{ '{{ variable }}' }} pour insérer des variables</small>
            @error('contenu_html')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="contenu_pdf">Contenu PDF <span class="text-danger">*</span></label>
            <textarea name="contenu_pdf" id="contenu_pdf" rows="15" class="form-control font-monospace @error('contenu_pdf') is-invalid @enderror" required>{{ old('contenu_pdf', $modeleDocument->contenu_pdf ?? '') }}</textarea>
            <small class="text-muted">Version optimisée pour PDF</small>
            @error('contenu_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_default" id="is_default" class="custom-control-input" value="1" {{ old('is_default', $modeleDocument->is_default ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_default">Modèle par défaut</label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_active" id="is_active" class="custom-control-input" value="1" {{ old('is_active', $modeleDocument->is_active ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_active">Actif</label>
            </div>
        </div>
    </div>
</div>

@push('juridique-scripts')
<script>
    $('#titre').on('keyup', function() {
        if ($('#slug').val() === '') {
            $('#slug').val($(this).val().toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''));
        }
    });
    $('#variables, #champs_requis').on('change', function() {
        try { JSON.parse($(this).val()); $(this).removeClass('is-invalid'); } catch(e) { $(this).addClass('is-invalid'); }
    });
</script>
@endpush
