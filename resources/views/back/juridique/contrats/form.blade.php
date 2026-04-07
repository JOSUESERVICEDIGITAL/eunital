<div class="form-group">
    <label for="document_id">Document associé <span class="text-danger">*</span></label>
    <select name="document_id" id="document_id" class="form-control @error('document_id') is-invalid @enderror" required>
        <option value="">Sélectionner un document</option>
        @foreach($documents as $doc)
        <option value="{{ $doc->id }}" {{ old('document_id', $contrat->document_id ?? '') == $doc->id ? 'selected' : '' }}>{{ $doc->titre }} ({{ $doc->numero_unique }})</option>
        @endforeach
    </select>
    @error('document_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_contrat">Type de contrat <span class="text-danger">*</span></label>
            <select name="type_contrat" id="type_contrat" class="form-control @error('type_contrat') is-invalid @enderror" required>
                <option value="prestation" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'prestation' ? 'selected' : '' }}>Prestation de services</option>
                <option value="partenariat" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'partenariat' ? 'selected' : '' }}>Partenariat</option>
                <option value="confidentialite" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'confidentialite' ? 'selected' : '' }}>Confidentialité (NDA)</option>
                <option value="licence" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'licence' ? 'selected' : '' }}>Licence</option>
                <option value="location" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'location' ? 'selected' : '' }}>Location</option>
                <option value="vente" {{ old('type_contrat', $contrat->type_contrat ?? '') == 'vente' ? 'selected' : '' }}>Vente</option>
            </select>
            @error('type_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="reference">Référence unique</label>
            <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference', $contrat->reference ?? '') }}" placeholder="Généré automatiquement">
            <small>Laissez vide pour génération automatique</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_debut">Date de début <span class="text-danger">*</span></label>
            <input type="date" name="date_debut" id="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', isset($contrat) && $contrat->date_debut ? $contrat->date_debut->format('Y-m-d') : date('Y-m-d')) }}" required>
            @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin', isset($contrat) && $contrat->date_fin ? $contrat->date_fin->format('Y-m-d') : '') }}">
            @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="montant">Montant</label>
            <input type="number" name="montant" id="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant', $contrat->montant ?? '') }}" step="0.01">
            @error('montant')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="devise">Devise</label>
            <select name="devise" id="devise" class="form-control">
                <option value="EUR" {{ old('devise', $contrat->devise ?? 'EUR') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                <option value="USD" {{ old('devise', $contrat->devise ?? 'EUR') == 'USD' ? 'selected' : '' }}>USD - Dollar US</option>
                <option value="GBP" {{ old('devise', $contrat->devise ?? 'EUR') == 'GBP' ? 'selected' : '' }}>GBP - Livre sterling</option>
                <option value="CHF" {{ old('devise', $contrat->devise ?? 'EUR') == 'CHF' ? 'selected' : '' }}>CHF - Franc suisse</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="objet">Objet du contrat</label>
    <textarea name="objet" id="objet" rows="2" class="form-control">{{ old('objet', $contrat->objet ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="duree_preavis">Durée de préavis (jours)</label>
            <input type="number" name="duree_preavis" id="duree_preavis" class="form-control" value="{{ old('duree_preavis', $contrat->duree_preavis ?? '') }}" min="0">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="custom-control custom-switch mt-4">
                <input type="checkbox" name="renouvellement_auto" id="renouvellement_auto" class="custom-control-input" value="1" {{ old('renouvellement_auto', $contrat->renouvellement_auto ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="renouvellement_auto">Renouvellement automatique</label>
            </div>
        </div>
    </div>
</div>

<div class="form-group" id="dureeRenouvellementGroup" style="display: none;">
    <label for="duree_renouvellement">Durée de renouvellement (jours)</label>
    <input type="number" name="duree_renouvellement" id="duree_renouvellement" class="form-control" value="{{ old('duree_renouvellement', $contrat->duree_renouvellement ?? '365') }}" min="1">
</div>

<div class="form-group">
    <label for="conditions">Conditions (JSON)</label>
    <textarea name="conditions" id="conditions" rows="3" class="form-control font-monospace">{{ old('conditions', isset($contrat) && $contrat->conditions ? json_encode($contrat->conditions, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

<div class="form-group">
    <label for="clauses">Clauses (JSON)</label>
    <textarea name="clauses" id="clauses" rows="3" class="form-control font-monospace">{{ old('clauses', isset($contrat) && $contrat->clauses ? json_encode($contrat->clauses, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

@push('juridique-scripts')
<script>
    $('#renouvellement_auto').on('change', function() { $('#dureeRenouvellementGroup').toggle(this.checked); });
    $('#renouvellement_auto').trigger('change');
    $('#reference').on('keyup', function() { if($(this).val() === '') { let type = $('#type_contrat').val(); let prefix = type.substring(0,3).toUpperCase(); let year = new Date().getFullYear(); let random = Math.random().toString(36).substring(2,6).toUpperCase(); $(this).val(prefix + '-' + year + '-' + random); } });
</script>
@endpush