<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de la campagne</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
               value="{{ old('titre', $campagneMarketing->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Réseau</label>
        <select name="reseau" class="form-select form-select-lg rounded-4 @error('reseau') is-invalid @enderror">
            <option value="facebook" @selected(old('reseau', $campagneMarketing->reseau ?? 'facebook') === 'facebook')>Facebook</option>
            <option value="instagram" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'instagram')>Instagram</option>
            <option value="tiktok" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'tiktok')>TikTok</option>
            <option value="google" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'google')>Google</option>
            <option value="linkedin" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'linkedin')>LinkedIn</option>
            <option value="youtube" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'youtube')>YouTube</option>
            <option value="multi_reseaux" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'multi_reseaux')>Multi-réseaux</option>
            <option value="autre" @selected(old('reseau', $campagneMarketing->reseau ?? '') === 'autre')>Autre</option>
        </select>
        @error('reseau')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $campagneMarketing->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('responsable_id', $campagneMarketing->responsable_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Objectif</label>
        <input type="text" name="objectif" class="form-control form-control-lg rounded-4"
               value="{{ old('objectif', $campagneMarketing->objectif ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Audience</label>
        <input type="text" name="audience" class="form-control form-control-lg rounded-4"
               value="{{ old('audience', $campagneMarketing->audience ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="brouillon" @selected(old('statut', $campagneMarketing->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="active" @selected(old('statut', $campagneMarketing->statut ?? '') === 'active')>Active</option>
            <option value="en_pause" @selected(old('statut', $campagneMarketing->statut ?? '') === 'en_pause')>En pause</option>
            <option value="terminee" @selected(old('statut', $campagneMarketing->statut ?? '') === 'terminee')>Terminée</option>
            <option value="archivee" @selected(old('statut', $campagneMarketing->statut ?? '') === 'archivee')>Archivée</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Budget</label>
        <input type="number" step="0.01" name="budget" class="form-control form-control-lg rounded-4"
               value="{{ old('budget', $campagneMarketing->budget ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Budget consommé</label>
        <input type="number" step="0.01" name="budget_consomme" class="form-control form-control-lg rounded-4"
               value="{{ old('budget_consomme', $campagneMarketing->budget_consomme ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date début</label>
        <input type="date" name="date_debut" class="form-control form-control-lg rounded-4"
               value="{{ old('date_debut', isset($campagneMarketing?->date_debut) ? $campagneMarketing->date_debut->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date fin</label>
        <input type="date" name="date_fin" class="form-control form-control-lg rounded-4"
               value="{{ old('date_fin', isset($campagneMarketing?->date_fin) ? $campagneMarketing->date_fin->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Taux conversion</label>
        <input type="number" step="0.01" name="taux_conversion" class="form-control form-control-lg rounded-4"
               value="{{ old('taux_conversion', $campagneMarketing->taux_conversion ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Coût par résultat</label>
        <input type="number" step="0.01" name="cout_par_resultat" class="form-control form-control-lg rounded-4"
               value="{{ old('cout_par_resultat', $campagneMarketing->cout_par_resultat ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Lien annonce</label>
        <input type="url" name="lien_annonce" class="form-control form-control-lg rounded-4"
               value="{{ old('lien_annonce', $campagneMarketing->lien_annonce ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Visuel</label>
        <input type="text" name="visuel" class="form-control form-control-lg rounded-4"
               value="{{ old('visuel', $campagneMarketing->visuel ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5" class="form-control rounded-4">{{ old('description', $campagneMarketing->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" name="est_active" value="1" id="est_active"
                   @checked(old('est_active', $campagneMarketing->est_active ?? false))>
            <label class="form-check-label fw-semibold" for="est_active">Campagne active</label>
        </div>
    </div>
</div>