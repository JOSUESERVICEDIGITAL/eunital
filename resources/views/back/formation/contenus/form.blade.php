<div class="form-group">
    <label for="type">Type de contenu <span class="text-danger">*</span></label>
    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
        <option value="">Sélectionner un type</option>
        <option value="video" {{ old('type', $contenu->type ?? '') == 'video' ? 'selected' : '' }}>Vidéo</option>
        <option value="document" {{ old('type', $contenu->type ?? '') == 'document' ? 'selected' : '' }}>Document</option>
        <option value="image" {{ old('type', $contenu->type ?? '') == 'image' ? 'selected' : '' }}>Image</option>
        <option value="audio" {{ old('type', $contenu->type ?? '') == 'audio' ? 'selected' : '' }}>Audio</option>
        <option value="quiz" {{ old('type', $contenu->type ?? '') == 'quiz' ? 'selected' : '' }}>Quiz</option>
        <option value="exercice" {{ old('type', $contenu->type ?? '') == 'exercice' ? 'selected' : '' }}>Exercice</option>
        <option value="tutoriel" {{ old('type', $contenu->type ?? '') == 'tutoriel' ? 'selected' : '' }}>Tutoriel</option>
    </select>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="titre">Titre <span class="text-danger">*</span></label>
    <input type="text" name="titre" id="titre" 
           class="form-control @error('titre') is-invalid @enderror" 
           value="{{ old('titre', $contenu->titre ?? '') }}" 
           required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="chapitre_id">Chapitre <span class="text-danger">*</span></label>
    <select name="chapitre_id" id="chapitre_id" 
            class="form-control select2 @error('chapitre_id') is-invalid @enderror" required>
        <option value="">Sélectionner un chapitre</option>
        @foreach($chapitres as $chapitreItem)
        <option value="{{ $chapitreItem->id }}" 
            {{ old('chapitre_id', $contenu->chapitre_id ?? '') == $chapitreItem->id ? 'selected' : '' }}>
            {{ $chapitreItem->cour->titre }} - {{ $chapitreItem->titre }}
        </option>
        @endforeach
    </select>
    @error('chapitre_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="ordre">Ordre d'affichage</label>
    <input type="number" name="ordre" id="ordre" 
           class="form-control @error('ordre') is-invalid @enderror" 
           value="{{ old('ordre', $contenu->ordre ?? '') }}" 
           min="0">
    <small class="form-text text-muted">Laissez vide pour ajouter à la fin du chapitre</small>
    @error('ordre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="file-upload-section">
    <div class="form-group">
        <label for="fichier">Fichier</label>
        @if(isset($contenu) && $contenu->fichier)
            <div class="mb-2">
                <span class="badge badge-info">
                    <i class="fas fa-file"></i> Fichier actuel : {{ basename($contenu->fichier) }}
                </span>
                <br>
                <small class="text-muted">Laissez vide pour conserver le fichier actuel</small>
            </div>
        @endif
        <input type="file" name="fichier" id="fichier" 
               class="form-control-file @error('fichier') is-invalid @enderror"
               accept=".mp4,.webm,.ogg,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.svg,.mp3,.wav">
        <small class="form-text text-muted" id="fileHelp">Formats acceptés selon le type choisi. Max: 100 Mo</small>
        @error('fichier')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="text-content-section">
    <div class="form-group">
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu" rows="10" 
                  class="form-control @error('contenu') is-invalid @enderror">{{ old('contenu', $contenu->contenu ?? '') }}</textarea>
        <small class="form-text text-muted">Description détaillée ou contenu textuel</small>
        @error('contenu')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="telechargeable" id="telechargeable" class="custom-control-input" 
                       value="1" {{ old('telechargeable', $contenu->telechargeable ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="telechargeable">
                    <i class="fas fa-download"></i> Téléchargeable
                </label>
            </div>
            <small class="form-text text-muted">Permet aux apprenants de télécharger le fichier</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="is_visible" id="is_visible" class="custom-control-input" 
                       value="1" {{ old('is_visible', $contenu->is_visible ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_visible">
                    <i class="fas fa-eye"></i> Visible
                </label>
            </div>
            <small class="form-text text-muted">Les contenus masqués ne sont pas accessibles aux apprenants</small>
        </div>
    </div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2 pour les chapitres
        $('#chapitre_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un chapitre',
            allowClear: true
        });
        
        // Gestion de l'affichage selon le type
        function updateFormByType() {
            var type = $('#type').val();
            if (type === 'video' || type === 'document' || type === 'image' || type === 'audio') {
                $('.file-upload-section').show();
                $('.text-content-section').hide();
                $('#fichier').prop('required', !$('#fichier').val());
                $('#contenu').prop('required', false);
                $('#fileHelp').html('Formats acceptés: ' + getAcceptedFormats(type) + '. Max: 100 Mo');
            } else if (type === 'quiz' || type === 'exercice' || type === 'tutoriel') {
                $('.file-upload-section').hide();
                $('.text-content-section').show();
                $('#fichier').prop('required', false);
                $('#contenu').prop('required', true);
            } else {
                $('.file-upload-section').hide();
                $('.text-content-section').hide();
            }
        }
        
        function getAcceptedFormats(type) {
            switch(type) {
                case 'video':
                    return 'MP4, WebM, OGG';
                case 'document':
                    return 'PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX';
                case 'image':
                    return 'JPG, JPEG, PNG, GIF, SVG';
                case 'audio':
                    return 'MP3, WAV, OGG';
                default:
                    return '';
            }
        }
        
        $('#type').on('change', updateFormByType);
        updateFormByType();
        
        // Si le chapitre est pré-sélectionné via l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const chapitreId = urlParams.get('chapitre_id');
        if(chapitreId && $('#chapitre_id').val() === '') {
            $('#chapitre_id').val(chapitreId).trigger('change');
        }
        
        // Si le type est pré-sélectionné via l'URL
        const typeParam = urlParams.get('type');
        if(typeParam && $('#type').val() === '') {
            $('#type').val(typeParam).trigger('change');
        }
    });
</script>
@endpush