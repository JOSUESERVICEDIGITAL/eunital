<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre du tableau</label>
        <input type="text" name="titre"
               class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
               value="{{ old('titre', $tableauPerformanceMarketing->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="brouillon" @selected(old('statut', $tableauPerformanceMarketing->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="publie" @selected(old('statut', $tableauPerformanceMarketing->statut ?? '') === 'publie')>Publié</option>
            <option value="archive" @selected(old('statut', $tableauPerformanceMarketing->statut ?? '') === 'archive')>Archivé</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}"
                    @selected(old('auteur_id', $tableauPerformanceMarketing->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Campagne liée</label>
        <select name="campagne_marketing_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucune campagne</option>
            @foreach($campagnes as $campagne)
                <option value="{{ $campagne->id }}"
                    @selected(old('campagne_marketing_id', $tableauPerformanceMarketing->campagne_marketing_id ?? '') == $campagne->id)>
                    {{ $campagne->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Impressions</label>
        <input type="number" name="impressions"
               class="form-control form-control-lg rounded-4"
               value="{{ old('impressions', $tableauPerformanceMarketing->impressions ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Clics</label>
        <input type="number" name="clics"
               class="form-control form-control-lg rounded-4"
               value="{{ old('clics', $tableauPerformanceMarketing->clics ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Conversions</label>
        <input type="number" name="conversions"
               class="form-control form-control-lg rounded-4"
               value="{{ old('conversions', $tableauPerformanceMarketing->conversions ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Leads</label>
        <input type="number" name="leads"
               class="form-control form-control-lg rounded-4"
               value="{{ old('leads', $tableauPerformanceMarketing->leads ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Ventes</label>
        <input type="number" name="ventes"
               class="form-control form-control-lg rounded-4"
               value="{{ old('ventes', $tableauPerformanceMarketing->ventes ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">CTR</label>
        <input type="number" step="0.01" name="ctr"
               class="form-control form-control-lg rounded-4"
               value="{{ old('ctr', $tableauPerformanceMarketing->ctr ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">CPC</label>
        <input type="number" step="0.01" name="cpc"
               class="form-control form-control-lg rounded-4"
               value="{{ old('cpc', $tableauPerformanceMarketing->cpc ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">CPM</label>
        <input type="number" step="0.01" name="cpm"
               class="form-control form-control-lg rounded-4"
               value="{{ old('cpm', $tableauPerformanceMarketing->cpm ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">ROAS</label>
        <input type="number" step="0.01" name="roas"
               class="form-control form-control-lg rounded-4"
               value="{{ old('roas', $tableauPerformanceMarketing->roas ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Coût total</label>
        <input type="number" step="0.01" name="cout_total"
               class="form-control form-control-lg rounded-4"
               value="{{ old('cout_total', $tableauPerformanceMarketing->cout_total ?? 0) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Revenu généré</label>
        <input type="number" step="0.01" name="revenu_genere"
               class="form-control form-control-lg rounded-4"
               value="{{ old('revenu_genere', $tableauPerformanceMarketing->revenu_genere ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Période début</label>
        <input type="date" name="periode_debut"
               class="form-control form-control-lg rounded-4"
               value="{{ old('periode_debut', isset($tableauPerformanceMarketing?->periode_debut) ? $tableauPerformanceMarketing->periode_debut->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Période fin</label>
        <input type="date" name="periode_fin"
               class="form-control form-control-lg rounded-4"
               value="{{ old('periode_fin', isset($tableauPerformanceMarketing?->periode_fin) ? $tableauPerformanceMarketing->periode_fin->format('Y-m-d') : '') }}">
    </div>
</div>
