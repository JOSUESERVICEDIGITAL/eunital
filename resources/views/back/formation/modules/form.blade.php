<div class="form-group">
    <label for="titre">Titre du module <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" 
           class="form-control @error('titre') is-invalid @enderror" 
           value="{{ old('titre', $module->titre ?? '') }}" 
           required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" 
           class="form-control @error('slug') is-invalid @enderror" 
           value="{{ old('slug', $module->slug ?? '') }}">
    <small class="form-text text-muted">Laissez vide pour générer automatiquement</small>
    @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="categorie_module_id">Catégorie <span class="text-danger">*</span></label>
            <select name="categorie_module_id" id="categorie_module_id" 
                    class="form-control @error('categorie_module_id') is-invalid @enderror" required>
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" 
                    {{ old('categorie_module_id', $module->categorie_module_id ?? '') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
                @endforeach
            </select>
            @error('categorie_module_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="niveau">Niveau <span class="text-danger">*</span></label>
            <select name="niveau" id="niveau" 
                    class="form-control @error('niveau') is-invalid @enderror" required>
                <option value="debutant" {{ old('niveau', $module->niveau ?? '') == 'debutant' ? 'selected' : '' }}>Débutant</option>
                <option value="intermediaire" {{ old('niveau', $module->niveau ?? '') == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                <option value="avance" {{ old('niveau', $module->niveau ?? '') == 'avance' ? 'selected' : '' }}>Avancé</option>
                <option value="expert" {{ old('niveau', $module->niveau ?? '') == 'expert' ? 'selected' : '' }}>Expert</option>
            </select>
            @error('niveau')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description <span class="text-danger">*</span></label>
    <textarea name="description" id="description" rows="5" 
              class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $module->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="duree_estimee">Durée estimée (heures)</label>
            <input type="number" name="duree_estimee" id="duree_estimee" 
                   class="form-control @error('duree_estimee') is-invalid @enderror" 
                   value="{{ old('duree_estimee', $module->duree_estimee ?? '') }}" 
                   min="1">
            <small class="form-text text-muted">Durée totale estimée pour compléter le module</small>
            @error('duree_estimee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Statut</label>
            <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                <option value="1" {{ old('is_active', $module->is_active ?? true) ? 'selected' : '' }}>Actif</option>
                <option value="0" {{ old('is_active', $module->is_active ?? true) ? '' : 'selected' }}>Inactif</option>
            </select>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="image_couverture">Image de couverture</label>
    @if(isset($module) && $module->image_couverture)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $module->image_couverture) }}" 
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

@push('scripts')
<script>
    $(document).ready(function() {
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