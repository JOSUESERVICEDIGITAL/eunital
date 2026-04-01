<div class="form-group">
    <label for="titre">Titre du cours <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" 
           class="form-control @error('titre') is-invalid @enderror" 
           value="{{ old('titre', $cour->titre ?? '') }}" 
           required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" 
           class="form-control @error('slug') is-invalid @enderror" 
           value="{{ old('slug', $cour->slug ?? '') }}">
    <small class="form-text text-muted">Laissez vide pour générer automatiquement</small>
    @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="module_id">Module <span class="text-danger">*</span></label>
            <select name="module_id" id="module_id" 
                    class="form-control @error('module_id') is-invalid @enderror" required>
                <option value="">Sélectionner un module</option>
                @foreach($modules as $module)
                <option value="{{ $module->id }}" 
                    {{ old('module_id', $cour->module_id ?? '') == $module->id ? 'selected' : '' }}>
                    {{ $module->titre }} ({{ $module->categorie->nom ?? 'N/A' }})
                </option>
                @endforeach
            </select>
            @error('module_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="niveau_difficulte">Niveau de difficulté <span class="text-danger">*</span></label>
            <select name="niveau_difficulte" id="niveau_difficulte" 
                    class="form-control @error('niveau_difficulte') is-invalid @enderror" required>
                <option value="debutant" {{ old('niveau_difficulte', $cour->niveau_difficulte ?? '') == 'debutant' ? 'selected' : '' }}>Débutant</option>
                <option value="intermediaire" {{ old('niveau_difficulte', $cour->niveau_difficulte ?? '') == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                <option value="avance" {{ old('niveau_difficulte', $cour->niveau_difficulte ?? '') == 'avance' ? 'selected' : '' }}>Avancé</option>
                <option value="expert" {{ old('niveau_difficulte', $cour->niveau_difficulte ?? '') == 'expert' ? 'selected' : '' }}>Expert</option>
            </select>
            @error('niveau_difficulte')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description <span class="text-danger">*</span></label>
    <textarea name="description" id="description" rows="5" 
              class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $cour->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="objectifs">Objectifs pédagogiques</label>
    <textarea name="objectifs" id="objectifs" rows="4" 
              class="form-control @error('objectifs') is-invalid @enderror">{{ old('objectifs', $cour->objectifs ?? '') }}</textarea>
    <small class="form-text text-muted">Ce que les apprenants sauront faire après ce cours</small>
    @error('objectifs')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="pre_requis">Prérequis</label>
    <textarea name="pre_requis" id="pre_requis" rows="4" 
              class="form-control @error('pre_requis') is-invalid @enderror">{{ old('pre_requis', $cour->pre_requis ?? '') }}</textarea>
    <small class="form-text text-muted">Connaissances nécessaires avant de suivre ce cours</small>
    @error('pre_requis')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ordre">Ordre d'affichage</label>
            <input type="number" name="ordre" id="ordre" 
                   class="form-control @error('ordre') is-invalid @enderror" 
                   value="{{ old('ordre', $cour->ordre ?? 0) }}" 
                   min="0">
            <small class="form-text text-muted">Position dans le module</small>
            @error('ordre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="duree_estimee">Durée estimée (minutes)</label>
            <input type="number" name="duree_estimee" id="duree_estimee" 
                   class="form-control @error('duree_estimee') is-invalid @enderror" 
                   value="{{ old('duree_estimee', $cour->duree_estimee ?? '') }}" 
                   min="1">
            <small class="form-text text-muted">Temps estimé pour compléter le cours</small>
            @error('duree_estimee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="video_intro">Vidéo d'introduction (URL)</label>
    <input type="url" name="video_intro" id="video_intro" 
           class="form-control @error('video_intro') is-invalid @enderror" 
           value="{{ old('video_intro', $cour->video_intro ?? '') }}" 
           placeholder="https://www.youtube.com/watch?v=...">
    <small class="form-text text-muted">Lien YouTube ou Vimeo</small>
    @error('video_intro')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="image_couverture">Image de couverture</label>
    @if(isset($cour) && $cour->image_couverture)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $cour->image_couverture) }}" 
                 alt="Image actuelle" 
                 style="max-height: 100px;" 
                 class="img-thumbnail">
            <br>
            <small class="text-muted">Image actuelle</small>
        </div>
    @endif
    <input type="file" name="image_couverture" id="image_couverture" 
           class="form-control-file @error('image_couverture') is-invalid @enderror" 
           accept="image/*">
    <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
    @error('image_couverture')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_published" id="is_published" class="custom-control-input" 
                       value="1" {{ old('is_published', $cour->is_published ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_published">Publié immédiatement</label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_visible" id="is_visible" class="custom-control-input" 
                       value="1" {{ old('is_visible', $cour->is_visible ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_visible">Visible dans le catalogue</label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="commentable" id="commentable" class="custom-control-input" 
                       value="1" {{ old('commentable', $cour->commentable ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="commentable">Commentaires autorisés</label>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="enseignants">Enseignants</label>
    <select name="enseignants[]" id="enseignants" class="form-control select2 @error('enseignants') is-invalid @enderror" multiple>
        @foreach($enseignants ?? [] as $enseignant)
        <option value="{{ $enseignant->id }}" 
            {{ (isset($enseignantsActuels) && in_array($enseignant->id, $enseignantsActuels)) ? 'selected' : '' }}>
            {{ $enseignant->name }} ({{ $enseignant->email }})
        </option>
        @endforeach
    </select>
    <small class="form-text text-muted">Sélectionnez un ou plusieurs enseignants</small>
    @error('enseignants')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2 pour les enseignants
        $('#enseignants').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner des enseignants',
            allowClear: true
        });
        
        // Génération automatique du slug
        $('#titre').on('keyup', function() {
            if ($('#slug').val() === '' || $('#slug').val() === $(this).data('original-slug')) {
                let slug = $(this).val().toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                $('#slug').val(slug);
                $('#slug').data('original-slug', slug);
            }
        });
        
        $('#slug').data('original-slug', $('#slug').val());
        
        // Preview de l'image
        $('#image_couverture').on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-thumbnail').remove();
                    $('<img>', {
                        src: e.target.result,
                        class: 'img-thumbnail mt-2',
                        style: 'max-height: 100px'
                    }).insertAfter('#image_couverture');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush