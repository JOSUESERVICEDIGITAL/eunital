<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Titre du dossier</label>
        <input type="text"
               name="titre"
               class="form-control form-control-lg rounded-4"
               value="{{ old('titre', $dossier->titre ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Type de dossier</label>
        <select name="type_dossier" class="form-select form-select-lg rounded-4">
            <option value="litige" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'litige')>Litige</option>
            <option value="reclamation" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'reclamation')>Réclamation</option>
            <option value="rupture" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'rupture')>Rupture</option>
            <option value="non_paiement" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'non_paiement')>Non-paiement</option>
            <option value="contentieux" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'contentieux')>Contentieux</option>
            <option value="administratif" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'administratif')>Administratif</option>
            <option value="rh" @selected(old('type_dossier', $dossier->type_dossier ?? '') == 'rh')>RH</option>
            <option value="autre" @selected(old('type_dossier', $dossier->type_dossier ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Priorité</label>
        <select name="priorite" class="form-select form-select-lg rounded-4">
            <option value="faible" @selected(old('priorite', $dossier->priorite ?? '') == 'faible')>Faible</option>
            <option value="normale" @selected(old('priorite', $dossier->priorite ?? 'normale') == 'normale')>Normale</option>
            <option value="urgente" @selected(old('priorite', $dossier->priorite ?? '') == 'urgente')>Urgente</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Sélectionner --</option>
            @foreach($users ?? [] as $user)
                <option value="{{ $user->id }}"
                    @selected(old('responsable_id', $dossier->responsable_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Client</label>
        <select name="client_studio_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Sélectionner --</option>
            @foreach($clients ?? [] as $client)
                <option value="{{ $client->id }}"
                    @selected(old('client_studio_id', $dossier->client_studio_id ?? '') == $client->id)>
                    {{ $client->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="ouvert" @selected(old('statut', $dossier->statut ?? 'ouvert') == 'ouvert')>Ouvert</option>
            <option value="en_cours" @selected(old('statut', $dossier->statut ?? '') == 'en_cours')>En cours</option>
            <option value="ferme" @selected(old('statut', $dossier->statut ?? '') == 'ferme')>Fermé</option>
            <option value="archive" @selected(old('statut', $dossier->statut ?? '') == 'archive')>Archivé</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $dossier->description ?? '') }}</textarea>
    </div>

</div>
