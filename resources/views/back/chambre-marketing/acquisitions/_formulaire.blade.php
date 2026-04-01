<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de l’acquisition</label>
        <input type="text" name="titre"
               class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
               value="{{ old('titre', $acquisitionMarketing->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="active" @selected(old('statut', $acquisitionMarketing->statut ?? 'active') === 'active')>Active</option>
            <option value="optimisation" @selected(old('statut', $acquisitionMarketing->statut ?? '') === 'optimisation')>Optimisation</option>
            <option value="stoppee" @selected(old('statut', $acquisitionMarketing->statut ?? '') === 'stoppee')>Stoppée</option>
            <option value="archivee" @selected(old('statut', $acquisitionMarketing->statut ?? '') === 'archivee')>Archivée</option>
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
                    @selected(old('auteur_id', $acquisitionMarketing->auteur_id ?? '') == $utilisateur->id)>
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
                    @selected(old('campagne_marketing_id', $acquisitionMarketing->campagne_marketing_id ?? '') == $campagne->id)>
                    {{ $campagne->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Source</label>
        <input type="text" name="source"
               class="form-control form-control-lg rounded-4"
               value="{{ old('source', $acquisitionMarketing->source ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Canal</label>
        <input type="text" name="canal"
               class="form-control form-control-lg rounded-4"
               value="{{ old('canal', $acquisitionMarketing->canal ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Visiteurs</label>
        <input type="number" name="visiteurs"
               class="form-control form-control-lg rounded-4"
               value="{{ old('visiteurs', $acquisitionMarketing->visiteurs ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Leads</label>
        <input type="number" name="leads"
               class="form-control form-control-lg rounded-4"
               value="{{ old('leads', $acquisitionMarketing->leads ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Coût acquisition</label>
        <input type="number" step="0.01" name="cout_acquisition"
               class="form-control form-control-lg rounded-4"
               value="{{ old('cout_acquisition', $acquisitionMarketing->cout_acquisition ?? 0) }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Taux conversion</label>
        <input type="number" step="0.01" name="taux_conversion"
               class="form-control form-control-lg rounded-4"
               value="{{ old('taux_conversion', $acquisitionMarketing->taux_conversion ?? '') }}">
    </div>
</div>