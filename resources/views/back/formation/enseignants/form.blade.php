<div class="form-group">
    <label for="user_id">Utilisateur <span class="text-danger">*</span></label>
    <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required>
        <option value="">Sélectionner un utilisateur</option>
        @foreach($users ?? [] as $user)
        <option value="{{ $user->id }}" {{ old('user_id', $enseignant->user_id ?? '') == $user->id ? 'selected' : '' }}>
            {{ $user->name }} ({{ $user->email }})
        </option>
        @endforeach
    </select>
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="specialite">Spécialité</label>
    <input type="text" name="specialite" id="specialite" class="form-control @error('specialite') is-invalid @enderror" 
           value="{{ old('specialite', $enseignant->specialite ?? '') }}">
    @error('specialite')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="diplome">Diplôme principal</label>
    <input type="text" name="diplome" id="diplome" class="form-control @error('diplome') is-invalid @enderror" 
           value="{{ old('diplome', $enseignant->diplome ?? '') }}">
    @error('diplome')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="annees_experience">Années d'expérience</label>
    <input type="number" name="annees_experience" id="annees_experience" class="form-control @error('annees_experience') is-invalid @enderror" 
           value="{{ old('annees_experience', $enseignant->annees_experience ?? 0) }}" min="0">
    @error('annees_experience')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="biographie">Biographie</label>
    <textarea name="biographie" id="biographie" rows="5" class="form-control @error('biographie') is-invalid @enderror">{{ old('biographie', $enseignant->biographie ?? '') }}</textarea>
    @error('biographie')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="competences">Compétences (JSON)</label>
    <textarea name="competences" id="competences" rows="3" class="form-control font-monospace @error('competences') is-invalid @enderror" 
              placeholder='["PHP", "Laravel", "JavaScript"]'>{{ old('competences', isset($enseignant) && $enseignant->competences ? json_encode($enseignant->competences, JSON_PRETTY_PRINT) : '') }}</textarea>
    <small class="text-muted">Format JSON: ["Compétence 1", "Compétence 2"]</small>
    @error('competences')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="photo">Photo de profil</label>
    @if(isset($enseignant) && $enseignant->photo)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $enseignant->photo) }}" class="img-thumbnail" style="max-height: 100px;">
        </div>
    @endif
    <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror" accept="image/*">
    <small class="text-muted">Format: JPG, PNG. Max: 2 Mo</small>
    @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" name="is_active" id="is_active" class="custom-control-input" 
               value="1" {{ old('is_active', $enseignant->is_active ?? true) ? 'checked' : '' }}>
        <label class="custom-control-label" for="is_active">
            <i class="fas fa-check-circle"></i> Actif
        </label>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un utilisateur',
            allowClear: true
        });
        
        $('#photo').on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-thumbnail').remove();
                    $('<img>', {
                        src: e.target.result,
                        class: 'img-thumbnail mt-2',
                        style: 'max-height: 100px'
                    }).insertAfter('#photo');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush