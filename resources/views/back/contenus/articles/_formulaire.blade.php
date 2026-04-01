<div class="row g-4">
    <div class="col-md-12">
        <label for="titre" class="form-label fw-semibold">Titre de l’article</label>
        <input type="text"
               name="titre"
               id="titre"
               class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
               value="{{ old('titre', $article->titre ?? '') }}"
               placeholder="Entrez le titre de l’article">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="resume" class="form-label fw-semibold">Résumé</label>
        <textarea name="resume"
                  id="resume"
                  rows="4"
                  class="form-control rounded-4 @error('resume') is-invalid @enderror"
                  placeholder="Résumé court de l’article...">{{ old('resume', $article->resume ?? '') }}</textarea>
        @error('resume')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="contenu" class="form-label fw-semibold">Contenu</label>
        <textarea name="contenu"
                  id="contenu"
                  rows="10"
                  class="form-control rounded-4 @error('contenu') is-invalid @enderror"
                  placeholder="Rédige ici le contenu complet de l’article...">{{ old('contenu', $article->contenu ?? '') }}</textarea>
        @error('contenu')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="categorie_id" class="form-label fw-semibold">Catégorie</label>
        <select name="categorie_id" id="categorie_id" class="form-select form-select-lg rounded-4 @error('categorie_id') is-invalid @enderror">
            <option value="">Choisir une catégorie</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}"
                    @selected(old('categorie_id', $article->categorie_id ?? '') == $categorie->id)>
                    {{ $categorie->nom }}
                </option>
            @endforeach
        </select>
        @error('categorie_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="statut" class="form-label fw-semibold">Statut</label>
        <select name="statut" id="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="brouillon" @selected(old('statut', $article->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="publie" @selected(old('statut', $article->statut ?? '') === 'publie')>Publié</option>
            <option value="archive" @selected(old('statut', $article->statut ?? '') === 'archive')>Archivé</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="date_publication" class="form-label fw-semibold">Date de publication</label>
        <input type="datetime-local"
               name="date_publication"
               id="date_publication"
               class="form-control form-control-lg rounded-4 @error('date_publication') is-invalid @enderror"
               value="{{ old('date_publication', isset($article->date_publication) && $article->date_publication ? $article->date_publication->format('Y-m-d\TH:i') : '') }}">
        @error('date_publication')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="image_principale" class="form-label fw-semibold">Image principale</label>
        <input type="file"
               name="image_principale"
               id="image_principale"
               class="form-control form-control-lg rounded-4 @error('image_principale') is-invalid @enderror">
        @error('image_principale')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="etiquettes" class="form-label fw-semibold">Étiquettes</label>
        <select name="etiquettes[]" id="etiquettes" multiple class="form-select rounded-4 @error('etiquettes') is-invalid @enderror">
            @foreach($etiquettes as $etiquette)
                <option value="{{ $etiquette->id }}"
                    @selected(in_array($etiquette->id, old('etiquettes', isset($article) ? $article->etiquettes->pluck('id')->toArray() : [])))>
                    {{ $etiquette->nom }}
                </option>
            @endforeach
        </select>
        @error('etiquettes')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <div class="form-check form-switch mt-3">
            <input class="form-check-input" type="checkbox" role="switch" id="commentaires_actives"
                   name="commentaires_actives" value="1"
                   @checked(old('commentaires_actives', $article->commentaires_actives ?? true))>
            <label class="form-check-label" for="commentaires_actives">Commentaires activés</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-check form-switch mt-3">
            <input class="form-check-input" type="checkbox" role="switch" id="est_mis_en_avant"
                   name="est_mis_en_avant" value="1"
                   @checked(old('est_mis_en_avant', $article->est_mis_en_avant ?? false))>
            <label class="form-check-label" for="est_mis_en_avant">Mettre en avant</label>
        </div>
    </div>

    @if(isset($article) && $article->image_principale)
        <div class="col-12">
            <div class="existing-image-box">
                <span class="fw-semibold d-block mb-2">Image actuelle</span>
                <img src="{{ asset('storage/' . $article->image_principale) }}" alt="{{ $article->titre }}">
            </div>
        </div>
    @endif
</div>