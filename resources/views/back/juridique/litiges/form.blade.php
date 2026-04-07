<div class="form-group">
    <label for="titre">Titre <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $litige->titre ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="commercial" {{ old('type', $litige->type ?? '') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                <option value="social" {{ old('type', $litige->type ?? '') == 'social' ? 'selected' : '' }}>Social</option>
                <option value="civil" {{ old('type', $litige->type ?? '') == 'civil' ? 'selected' : '' }}>Civil</option>
                <option value="administratif" {{ old('type', $litige->type ?? '') == 'administratif' ? 'selected' : '' }}>Administratif</option>
                <option value="penal" {{ old('type', $litige->type ?? '') == 'penal' ? 'selected' : '' }}>Pénal</option>
                <option value="fiscal" {{ old('type', $litige->type ?? '') == 'fiscal' ? 'selected' : '' }}>Fiscal</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="ouvert" {{ old('statut', $litige->statut ?? 'ouvert') == 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                <option value="instruction" {{ old('statut', $litige->statut ?? '') == 'instruction' ? 'selected' : '' }}>En instruction</option>
                <option value="mediation" {{ old('statut', $litige->statut ?? '') == 'mediation' ? 'selected' : '' }}>Médiation</option>
                <option value="arbitrage" {{ old('statut', $litige->statut ?? '') == 'arbitrage' ? 'selected' : '' }}>Arbitrage</option>
                <option value="judiciaire" {{ old('statut', $litige->statut ?? '') == 'judiciaire' ? 'selected' : '' }}>Judiciaire</option>
                <option value="clos" {{ old('statut', $litige->statut ?? '') == 'clos' ? 'selected' : '' }}>Clos</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_ouverture">Date ouverture</label>
            <input type="date" name="date_ouverture" id="date_ouverture" class="form-control" value="{{ old('date_ouverture', isset($litige) && $litige->date_ouverture ? $litige->date_ouverture->format('Y-m-d') : date('Y-m-d')) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_cloture">Date clôture</label>
            <input type="date" name="date_cloture" id="date_cloture" class="form-control" value="{{ old('date_cloture', isset($litige) && $litige->date_cloture ? $litige->date_cloture->format('Y-m-d') : '') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="montant_en_jeu">Montant en jeu (€)</label>
            <input type="number" name="montant_en_jeu" id="montant_en_jeu" class="form-control" value="{{ old('montant_en_jeu', $litige->montant_en_jeu ?? '') }}" step="0.01">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="cout_total">Coût total (€)</label>
            <input type="number" name="cout_total" id="cout_total" class="form-control" value="{{ old('cout_total', $litige->cout_total ?? '') }}" step="0.01">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $litige->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="parties">Parties (JSON)</label>
    <textarea name="parties" id="parties" rows="3" class="form-control font-monospace">{{ old('parties', isset($litige) && $litige->parties ? json_encode($litige->parties, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

<div class="form-group">
    <label for="conclusion">Conclusion</label>
    <textarea name="conclusion" id="conclusion" rows="3" class="form-control">{{ old('conclusion', $litige->conclusion ?? '') }}</textarea>
</div>