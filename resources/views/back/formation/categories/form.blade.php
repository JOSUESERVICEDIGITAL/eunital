<div class="form-group">
    <label for="nom">Nom <span class="text-danger">*</span></label>
    <input type="text" name="nom" id="nom" 
           class="form-control @error('nom') is-invalid @enderror" 
           value="{{ old('nom', $categorieModule->nom ?? '') }}" 
           required>
    @error('nom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" 
           class="form-control @error('slug') is-invalid @enderror" 
           value="{{ old('slug', $categorieModule->slug ?? '') }}">
    <small class="form-text text-muted">
        Laissez vide pour générer automatiquement à partir du nom
    </small>
    @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4" 
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $categorieModule->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ordre">Ordre d'affichage</label>
            <input type="number" name="ordre" id="ordre" 
                   class="form-control @error('ordre') is-invalid @enderror" 
                   value="{{ old('ordre', $categorieModule->ordre ?? 0) }}"