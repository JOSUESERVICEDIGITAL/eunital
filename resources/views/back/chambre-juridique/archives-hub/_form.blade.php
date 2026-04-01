<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Titre de l’archive</label>
        <input type="text"
               name="titre"
               class="form-control form-control-lg rounded-4"
               value="{{ old('titre', $archive->titre ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Catégorie</label>
        <select name="categorie" class="form-select form-select-lg rounded-4">
            <option value="fondation" @selected(old('categorie', $archive->categorie ?? '') == 'fondation')>Fondation</option>
            <option value="inauguration" @selected(old('categorie', $archive->categorie ?? '') == 'inauguration')>Inauguration</option>
            <option value="historique" @selected(old('categorie', $archive->categorie ?? '') == 'historique')>Historique</option>
            <option value="photo" @selected(old('categorie', $archive->categorie ?? '') == 'photo')>Photo</option>
            <option value="video" @selected(old('categorie', $archive->categorie ?? '') == 'video')>Vidéo</option>
            <option value="document" @selected(old('categorie', $archive->categorie ?? '') == 'document')>Document</option>
            <option value="media" @selected(old('categorie', $archive->categorie ?? '') == 'media')>Média</option>
            <option value="autre" @selected(old('categorie', $archive->categorie ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Type fichier</label>
        <select name="type_fichier" class="form-select form-select-lg rounded-4">
            <option value="image" @selected(old('type_fichier', $archive->type_fichier ?? '') == 'image')>Image</option>
            <option value="video" @selected(old('type_fichier', $archive->type_fichier ?? '') == 'video')>Vidéo</option>
            <option value="pdf" @selected(old('type_fichier', $archive->type_fichier ?? '') == 'pdf')>PDF</option>
            <option value="document" @selected(old('type_fichier', $archive->type_fichier ?? '') == 'document')>Document</option>
            <option value="audio" @selected(old('type_fichier', $archive->type_fichier ?? '') == 'audio')>Audio</option>
            <option value="autre" @selected(old('type_fichier', $archive->type_fichier ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date d’archive</label>
        <input type="date"
               name="date_archive"
               class="form-control form-control-lg rounded-4"
               value="{{ old('date_archive', isset($archive->date_archive) ? \Carbon\Carbon::parse($archive->date_archive)->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Fichier</label>
        <input type="file"
               name="fichier"
               class="form-control form-control-lg rounded-4">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $archive->description ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="visible" value="1"
                   id="archiveVisible"
                   @checked(old('visible', $archive->visible ?? false))>
            <label class="form-check-label fw-semibold" for="archiveVisible">
                Archive visible
            </label>
        </div>
    </div>

</div>