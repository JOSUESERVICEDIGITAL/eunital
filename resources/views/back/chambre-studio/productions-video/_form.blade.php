<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de la production</label>
        <input type="text"
               name="titre"
               class="form-control form-control-lg rounded-4"
               value="{{ old('titre', $productionVideo->titre ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Type</label>
        <select name="type" class="form-select form-select-lg rounded-4">
            <option value="clip" @selected(old('type', $productionVideo->type ?? 'clip') == 'clip')>Clip</option>
            <option value="spot" @selected(old('type', $productionVideo->type ?? '') == 'spot')>Spot</option>
            <option value="interview" @selected(old('type', $productionVideo->type ?? '') == 'interview')>Interview</option>
            <option value="evenement" @selected(old('type', $productionVideo->type ?? '') == 'evenement')>Événement</option>
            <option value="mariage" @selected(old('type', $productionVideo->type ?? '') == 'mariage')>Mariage</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Client</label>
        <select name="client_studio_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Sélectionner --</option>
            @foreach($clients as $id => $nom)
                <option value="{{ $id }}"
                    @selected(old('client_studio_id', $productionVideo->client_studio_id ?? '') == $id)>
                    {{ $nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Projet</label>
        <select name="projet_studio_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Sélectionner --</option>
            @foreach($projets as $id => $titre)
                <option value="{{ $id }}"
                    @selected(old('projet_studio_id', $productionVideo->projet_studio_id ?? '') == $id)>
                    {{ $titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="tournage" @selected(old('statut', $productionVideo->statut ?? 'tournage') == 'tournage')>Tournage</option>
            <option value="montage" @selected(old('statut', $productionVideo->statut ?? '') == 'montage')>Montage</option>
            <option value="validation" @selected(old('statut', $productionVideo->statut ?? '') == 'validation')>Validation</option>
            <option value="livre" @selected(old('statut', $productionVideo->statut ?? '') == 'livre')>Livré</option>
            <option value="archive" @selected(old('statut', $productionVideo->statut ?? '') == 'archive')>Archivé</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Fichier vidéo</label>
        <input type="text"
               name="fichier_video"
               class="form-control form-control-lg rounded-4"
               value="{{ old('fichier_video', $productionVideo->fichier_video ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5" class="form-control rounded-4">{{ old('description', $productionVideo->description ?? '') }}</textarea>
    </div>

</div>