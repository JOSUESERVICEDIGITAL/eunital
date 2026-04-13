<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="titre">Titre <span class="text-danger">*</span></label>
            <input type="text" name="titre" id="titre"
                   class="form-control @error('titre') is-invalid @enderror"
                   value="{{ old('titre', $salle->titre ?? '') }}"
                   placeholder="Ex: Salle Laravel Avancé" required>
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug"
                   class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug', $salle->slug ?? '') }}"
                   placeholder="auto-genere-si-vide">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4"
              class="form-control @error('description') is-invalid @enderror"
              placeholder="Présente la salle, ses objectifs, ses contenus et son usage...">{{ old('description', $salle->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="cour_id">Cours lié</label>
            <select name="cour_id" id="cour_id" class="form-control @error('cour_id') is-invalid @enderror">
                <option value="">Aucun cours</option>
                @foreach($cours as $cour)
                    <option value="{{ $cour->id }}" {{ old('cour_id', $salle->cour_id ?? '') == $cour->id ? 'selected' : '' }}>
                        {{ $cour->titre }}
                    </option>
                @endforeach
            </select>
            @error('cour_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="module_id">Module lié</label>
            <select name="module_id" id="module_id" class="form-control @error('module_id') is-invalid @enderror">
                <option value="">Aucun module</option>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ old('module_id', $salle->module_id ?? '') == $module->id ? 'selected' : '' }}>
                        {{ $module->titre }}
                    </option>
                @endforeach
            </select>
            @error('module_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="acces_salle_id">Code d’accès lié</label>
            <select name="acces_salle_id" id="acces_salle_id" class="form-control @error('acces_salle_id') is-invalid @enderror">
                <option value="">Aucun code</option>
                @foreach($accesSalles as $acces)
                    <option value="{{ $acces->id }}" {{ old('acces_salle_id', $salle->acces_salle_id ?? '') == $acces->id ? 'selected' : '' }}>
                        {{ $acces->code_acces }} — {{ $acces->cour->titre ?? 'Cours N/A' }}
                    </option>
                @endforeach
            </select>
            @error('acces_salle_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="type_salle">Type de salle <span class="text-danger">*</span></label>
            <select name="type_salle" id="type_salle" class="form-control @error('type_salle') is-invalid @enderror" required>
                <option value="distance" {{ old('type_salle', $salle->type_salle ?? 'distance') == 'distance' ? 'selected' : '' }}>Distance</option>
                <option value="presentiel" {{ old('type_salle', $salle->type_salle ?? '') == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                <option value="hybride" {{ old('type_salle', $salle->type_salle ?? '') == 'hybride' ? 'selected' : '' }}>Hybride</option>
            </select>
            @error('type_salle')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="image_couverture">Image de couverture</label>
            <input type="file" name="image_couverture" id="image_couverture"
                   class="form-control-file @error('image_couverture') is-invalid @enderror">
            @error('image_couverture')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4 d-flex align-items-center">
        <div class="form-check mr-4">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                   value="1" {{ old('is_active', $salle->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Salle active</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_open" id="is_open" class="form-check-input"
                   value="1" {{ old('is_open', $salle->is_open ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_open">Salle ouverte</label>
        </div>
    </div>
</div>

<hr>

<h5 class="mb-3">
    <i class="fas fa-sliders-h mr-2"></i>
    Paramètres de la salle
</h5>

<div class="row">
    @php
        $parametres = old('parametres', $salle->parametres ?? []);
    @endphp

    <div class="col-md-4">
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="chat_active" name="parametres[chat_active]" value="1"
                   {{ !empty($parametres['chat_active']) ? 'checked' : '' }}>
            <label class="form-check-label" for="chat_active">Chat actif</label>
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="documents_visibles" name="parametres[documents_visibles]" value="1"
                   {{ !empty($parametres['documents_visibles']) ? 'checked' : '' }}>
            <label class="form-check-label" for="documents_visibles">Documents visibles</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="videos_visibles" name="parametres[videos_visibles]" value="1"
                   {{ !empty($parametres['videos_visibles']) ? 'checked' : '' }}>
            <label class="form-check-label" for="videos_visibles">Vidéos visibles</label>
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="devoirs_visibles" name="parametres[devoirs_visibles]" value="1"
                   {{ !empty($parametres['devoirs_visibles']) ? 'checked' : '' }}>
            <label class="form-check-label" for="devoirs_visibles">Devoirs visibles</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="tutoriels_visibles" name="parametres[tutoriels_visibles]" value="1"
                   {{ !empty($parametres['tutoriels_visibles']) ? 'checked' : '' }}>
            <label class="form-check-label" for="tutoriels_visibles">Tutoriels visibles</label>
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="telechargement_autorise" name="parametres[telechargement_autorise]" value="1"
                   {{ !empty($parametres['telechargement_autorise']) ? 'checked' : '' }}>
            <label class="form-check-label" for="telechargement_autorise">Téléchargement autorisé</label>
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="qr_active" name="parametres[qr_active]" value="1"
                   {{ !empty($parametres['qr_active']) ? 'checked' : '' }}>
            <label class="form-check-label" for="qr_active">QR code actif</label>
        </div>
    </div>
</div>
