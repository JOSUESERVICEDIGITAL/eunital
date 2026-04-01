<div class="form-group">
    <label for="titre">Titre du chapitre <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" 
           class="form-control @error('titre') is-invalid @enderror" 
           value="{{ old('titre', $chapitre->titre ?? '') }}" 
           required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4" 
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $chapitre->description ?? '') }}</textarea>
    <small class="form-text text-muted">Brève description du contenu du chapitre</small>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="cour_id">Cours <span class="text-danger">*</span></label>
            <select name="cour_id" id="cour_id" 
                    class="form-control @error('cour_id') is-invalid @enderror" required>
                <option value="">Sélectionner un cours</option>
                @foreach($cours as $courItem)
                <option value="{{ $courItem->id }}" 
                    {{ old('cour_id', $chapitre->cour_id ?? '') == $courItem->id ? 'selected' : '' }}>
                    {{ $courItem->titre }} ({{ $courItem->module->titre ?? 'N/A' }})
                </option>
                @endforeach
            </select>
            @error('cour_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ordre">Ordre d'affichage</label>
            <input type="number" name="ordre" id="ordre" 
                   class="form-control @error('ordre') is-invalid @enderror" 
                   value="{{ old('ordre', $chapitre->ordre ?? '') }}" 
                   min="0">
            <small class="form-text text-muted">Laissez vide pour ajouter à la fin</small>
            @error('ordre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="duree_estimee">Durée estimée (minutes)</label>
            <input type="number" name="duree_estimee" id="duree_estimee" 
                   class="form-control @error('duree_estimee') is-invalid @enderror" 
                   value="{{ old('duree_estimee', $chapitre->duree_estimee ?? '') }}" 
                   min="1">
            <small class="form-text text-muted">Temps estimé pour compléter ce chapitre</small>
            @error('duree_estimee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="custom-control custom-switch mt-4">
                <input type="checkbox" name="is_free" id="is_free" class="custom-control-input" 
                       value="1" {{ old('is_free', $chapitre->is_free ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_free">
                    <i class="fas fa-gift"></i> Chapitre gratuit
                </label>
            </div>
            <small class="form-text text-muted">Les chapitres gratuits sont accessibles sans inscription</small>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Si le cours est pré-sélectionné via l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const courId = urlParams.get('cour_id');
        if(courId && $('#cour_id').val() === '') {
            $('#cour_id').val(courId);
        }
    });
</script>
@endpush