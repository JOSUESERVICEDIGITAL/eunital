<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nom complet</label>
        <input type="text"
               name="nom_complet"
               class="form-control form-control-lg rounded-4"
               value="{{ old('nom_complet', $engagement->nom_complet ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email"
               name="email"
               class="form-control form-control-lg rounded-4"
               value="{{ old('email', $engagement->email ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Téléphone</label>
        <input type="text"
               name="telephone"
               class="form-control form-control-lg rounded-4"
               value="{{ old('telephone', $engagement->telephone ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Type d'engagement</label>
        <select name="type_engagement" class="form-select form-select-lg rounded-4">
            <option value="embauche" @selected(old('type_engagement', $engagement->type_engagement ?? '') == 'embauche')>Embauche</option>
            <option value="consultance" @selected(old('type_engagement', $engagement->type_engagement ?? '') == 'consultance')>Consultance</option>
            <option value="stage" @selected(old('type_engagement', $engagement->type_engagement ?? '') == 'stage')>Stage</option>
            <option value="prestation" @selected(old('type_engagement', $engagement->type_engagement ?? '') == 'prestation')>Prestation</option>
            <option value="formation" @selected(old('type_engagement', $engagement->type_engagement ?? '') == 'formation')>Formation</option>
            <option value="benevolat" @selected(old('type_engagement', $engagement->type_engagement ?? '') == 'benevolat')>Bénévolat</option>
            <option value="autre" @selected(old('type_engagement', $engagement->type_engagement ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Service concerné</label>
        <input type="text"
               name="service_concerne"
               class="form-control form-control-lg rounded-4"
               value="{{ old('service_concerne', $engagement->service_concerne ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Chambre source</label>
        <input type="text"
               name="chambre_source"
               class="form-control form-control-lg rounded-4"
               value="{{ old('chambre_source', $engagement->chambre_source ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Fichier formulaire</label>
        <input type="file"
               name="fichier_formulaire"
               class="form-control form-control-lg rounded-4">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Fichier contrat</label>
        <input type="file"
               name="fichier_contrat"
               class="form-control form-control-lg rounded-4">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5" class="form-control rounded-4">{{ old('description', $engagement->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Observation</label>
        <textarea name="observation" rows="4" class="form-control rounded-4">{{ old('observation', $engagement->observation ?? '') }}</textarea>
    </div>

</div>
