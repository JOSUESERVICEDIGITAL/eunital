<div class="form-group">
    <label for="titre">Titre du devoir <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" 
           class="form-control @error('titre') is-invalid @enderror" 
           value="{{ old('titre', $devoir->titre ?? '') }}" 
           required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description <span class="text-danger">*</span></label>
    <textarea name="description" id="description" rows="6" 
              class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $devoir->description ?? '') }}</textarea>
    <small class="form-text text-muted">Décrivez le devoir, les consignes, le barème, etc.</small>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="cour_id">Cours <span class="text-danger">*</span></label>
            <select name="cour_id" id="cour_id" 
                    class="form-control select2 @error('cour_id') is-invalid @enderror" required>
                <option value="">Sélectionner un cours</option>
                @foreach($cours as $courItem)
                <option value="{{ $courItem->id }}" 
                    {{ old('cour_id', $devoir->cour_id ?? '') == $courItem->id ? 'selected' : '' }}>
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
            <label for="type">Type de devoir <span class="text-danger">*</span></label>
            <select name="type" id="type" 
                    class="form-control @error('type') is-invalid @enderror" required>
                <option value="exercice" {{ old('type', $devoir->type ?? '') == 'exercice' ? 'selected' : '' }}>Exercice</option>
                <option value="quiz" {{ old('type', $devoir->type ?? '') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                <option value="projet" {{ old('type', $devoir->type ?? '') == 'projet' ? 'selected' : '' }}>Projet</option>
                <option value="examen" {{ old('type', $devoir->type ?? '') == 'examen' ? 'selected' : '' }}>Examen</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="note_maximale">Note maximale</label>
            <input type="number" name="note_maximale" id="note_maximale" 
                   class="form-control @error('note_maximale') is-invalid @enderror" 
                   value="{{ old('note_maximale', $devoir->note_maximale ?? 20) }}" 
                   min="1" max="100" step="1">
            @error('note_maximale')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="duree_limite">Durée limite (minutes)</label>
            <input type="number" name="duree_limite" id="duree_limite" 
                   class="form-control @error('duree_limite') is-invalid @enderror" 
                   value="{{ old('duree_limite', $devoir->duree_limite ?? '') }}" 
                   min="1">
            <small class="form-text text-muted">Temps imparti pour réaliser le devoir</small>
            @error('duree_limite')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_limite">Date limite</label>
            <input type="datetime-local" name="date_limite" id="date_limite" 
                   class="form-control @error('date_limite') is-invalid @enderror" 
                   value="{{ old('date_limite', isset($devoir) && $devoir->date_limite ? \Carbon\Carbon::parse($devoir->date_limite)->format('Y-m-d\TH:i') : '') }}">
            <small class="form-text text-muted">Date limite de soumission</small>
            @error('date_limite')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="resources">Ressources (fichiers)</label>
            <input type="file" name="resources[]" id="resources" 
                   class="form-control-file @error('resources') is-invalid @enderror" 
                   multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,.jpg,.png">
            <small class="form-text text-muted">Fichiers joints au devoir (PDF, Word, Excel, PPT, ZIP, etc.)</small>
            @if(isset($devoir) && $devoir->resources)
                <div class="mt-2">
                    <strong>Fichiers actuels :</strong>
                    <ul class="list-unstyled">
                        @foreach($devoir->resources as $resource)
                        <li>
                            <i class="fas fa-file-alt text-primary"></i>
                            {{ $resource['name'] }}
                            <a href="{{ asset('storage/' . $resource['path']) }}" class="btn btn-sm btn-link" target="_blank">
                                <i class="fas fa-download"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @error('resources')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_published" id="is_published" class="custom-control-input" 
                       value="1" {{ old('is_published', $devoir->is_published ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_published">
                    <i class="fas fa-eye"></i> Publier immédiatement
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="visible" id="visible" class="custom-control-input" 
                       value="1" {{ old('visible', $devoir->visible ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="visible">
                    <i class="fas fa-eye"></i> Visible
                </label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2 pour le cours
        $('#cour_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un cours',
            allowClear: true
        });
        
        // Si un cours est pré-sélectionné via l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const courId = urlParams.get('cour_id');
        if(courId && $('#cour_id').val() === '') {
            $('#cour_id').val(courId).trigger('change');
        }
        
        // Validation de la date limite
        $('#date_limite').on('change', function() {
            var date = $(this).val();
            if (date && new Date(date) < new Date()) {
                $(this).addClass('is-invalid');
                $('<div class="invalid-feedback">La date limite ne peut pas être dans le passé</div>').insertAfter($(this));
            } else {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            }
        });
    });
</script>
@endpush