<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4" value="{{ old('titre', $applicationMobile->titre ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Version</label>
        <input type="text" name="version" class="form-control form-control-lg rounded-4" value="{{ old('version', $applicationMobile->version ?? '1.0') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $applicationMobile->auteur_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('responsable_id', $applicationMobile->responsable_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Plateforme</label>
        <select name="plateforme" class="form-select form-select-lg rounded-4">
            <option value="android" @selected(old('plateforme', $applicationMobile->plateforme ?? 'hybride') === 'android')>Android</option>
            <option value="ios" @selected(old('plateforme', $applicationMobile->plateforme ?? '') === 'ios')>iOS</option>
            <option value="hybride" @selected(old('plateforme', $applicationMobile->plateforme ?? 'hybride') === 'hybride')>Hybride</option>
            <option value="pwa" @selected(old('plateforme', $applicationMobile->plateforme ?? '') === 'pwa')>PWA</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="conception" @selected(old('statut', $applicationMobile->statut ?? 'conception') === 'conception')>Conception</option>
            <option value="en_developpement" @selected(old('statut', $applicationMobile->statut ?? '') === 'en_developpement')>En développement</option>
            <option value="en_test" @selected(old('statut', $applicationMobile->statut ?? '') === 'en_test')>En test</option>
            <option value="publiee" @selected(old('statut', $applicationMobile->statut ?? '') === 'publiee')>Publiée</option>
            <option value="suspendue" @selected(old('statut', $applicationMobile->statut ?? '') === 'suspendue')>Suspendue</option>
            <option value="archivee" @selected(old('statut', $applicationMobile->statut ?? '') === 'archivee')>Archivée</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4" class="form-control rounded-4">{{ old('description', $applicationMobile->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Stack mobile</label>
        <textarea name="stack_mobile" rows="5" class="form-control rounded-4">{{ old('stack_mobile', $applicationMobile->stack_mobile ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Lien démo</label>
        <input type="url" name="lien_demo" class="form-control form-control-lg rounded-4" value="{{ old('lien_demo', $applicationMobile->lien_demo ?? '') }}">
    </div>
</div>
