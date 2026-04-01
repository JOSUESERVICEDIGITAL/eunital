<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $media->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de média</label>
        <select name="type_media" class="form-select form-select-lg rounded-4 @error('type_media') is-invalid @enderror">
            <option value="image" @selected(old('type_media', $media->type_media ?? 'image') === 'image')>Image</option>
            <option value="video" @selected(old('type_media', $media->type_media ?? '') === 'video')>Vidéo</option>
            <option value="document" @selected(old('type_media', $media->type_media ?? '') === 'document')>Document</option>
            <option value="audio" @selected(old('type_media', $media->type_media ?? '') === 'audio')>Audio</option>
            <option value="lien" @selected(old('type_media', $media->type_media ?? '') === 'lien')>Lien externe</option>
        </select>
        @error('type_media')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Catégorie média</label>
        <select name="categorie_media_id" class="form-select form-select-lg rounded-4">
            <option value="">Choisir</option>
            @foreach($categoriesMedias as $categorieMedia)
                <option value="{{ $categorieMedia->id }}" @selected(old('categorie_media_id', $media->categorie_media_id ?? '') == $categorieMedia->id)>
                    {{ $categorieMedia->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Utilisateur lié</label>
        <select name="user_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur actuel / système</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('user_id', $media->user_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }} - {{ $utilisateur->email }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Fichier</label>
        <input type="file" name="fichier"
            class="form-control form-control-lg rounded-4 @error('fichier') is-invalid @enderror">
        @error('fichier')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Miniature</label>
        <input type="file" name="miniature"
            class="form-control form-control-lg rounded-4 @error('miniature') is-invalid @enderror">
        @error('miniature')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">URL externe</label>
        <input type="url" name="url_externe"
            class="form-control form-control-lg rounded-4 @error('url_externe') is-invalid @enderror"
            value="{{ old('url_externe', $media->url_externe ?? '') }}"
            placeholder="https://...">
        @error('url_externe')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Texte alternatif</label>
        <input type="text" name="alt_text"
            class="form-control form-control-lg rounded-4 @error('alt_text') is-invalid @enderror"
            value="{{ old('alt_text', $media->alt_text ?? '') }}">
        @error('alt_text')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $media->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="est_public" value="1"
                @checked(old('est_public', $media->est_public ?? true))>
            <label class="form-check-label">Média public</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="est_en_avant" value="1"
                @checked(old('est_en_avant', $media->est_en_avant ?? false))>
            <label class="form-check-label">Mettre en avant</label>
        </div>
    </div>

    @if(isset($media) && $media->miniature)
        <div class="col-md-6">
            <div class="existing-image-box">
                <span class="fw-semibold d-block mb-2">Miniature actuelle</span>
                <img src="{{ asset('storage/' . $media->miniature) }}" alt="{{ $media->titre }}">
            </div>
        </div>
    @endif

    @if(isset($media) && $media->fichier && $media->type_media === 'image')
        <div class="col-md-6">
            <div class="existing-image-box">
                <span class="fw-semibold d-block mb-2">Image actuelle</span>
                <img src="{{ asset('storage/' . $media->fichier) }}" alt="{{ $media->titre }}">
            </div>
        </div>
    @endif
</div>