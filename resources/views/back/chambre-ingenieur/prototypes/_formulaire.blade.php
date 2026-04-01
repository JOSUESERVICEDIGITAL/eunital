<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4" value="{{ old('titre', $prototypeIngenieurie->titre ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="en_cours" @selected(old('statut', $prototypeIngenieurie->statut ?? 'en_cours') === 'en_cours')>En cours</option>
            <option value="termine" @selected(old('statut', $prototypeIngenieurie->statut ?? '') === 'termine')>Terminé</option>
            <option value="abandonne" @selected(old('statut', $prototypeIngenieurie->statut ?? '') === 'abandonne')>Abandonné</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $prototypeIngenieurie->auteur_id ?? '') == $utilisateur->id)>{{ $utilisateur->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="4" class="form-control rounded-4">{{ old('description', $prototypeIngenieurie->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Objectif</label>
        <textarea name="objectif" rows="5" class="form-control rounded-4">{{ old('objectif', $prototypeIngenieurie->objectif ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Lien démo</label>
        <input type="url" name="lien_demo" class="form-control form-control-lg rounded-4" value="{{ old('lien_demo', $prototypeIngenieurie->lien_demo ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Dépôt source</label>
        <input type="url" name="depot_source" class="form-control form-control-lg rounded-4" value="{{ old('depot_source', $prototypeIngenieurie->depot_source ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Capture</label>
        <input type="file" name="captures" class="form-control form-control-lg rounded-4">
    </div>
</div>