<div class="form-group">
    <label for="type">Type de contenu <span class="text-danger">*</span></label>
    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
        <option value="">Sélectionner un type</option>
        <option value="video" {{ old('type', $contenu->type ?? '') == 'video' ? 'selected' : '' }}>Vidéo de cours</option>
        <option value="tutoriel" {{ old('type', $contenu->type ?? '') == 'tutoriel' ? 'selected' : '' }}>Tutoriel vidéo</option>
        <option value="document" {{ old('type', $contenu->type ?? '') == 'document' ? 'selected' : '' }}>Document (PDF, Word, etc.)</option>
        <option value="image" {{ old('type', $contenu->type ?? '') == 'image' ? 'selected' : '' }}>Image</option>
        <option value="audio" {{ old('type', $contenu->type ?? '') == 'audio' ? 'selected' : '' }}>Audio</option>
        <option value="quiz" {{ old('type', $contenu->type ?? '') == 'quiz' ? 'selected' : '' }}>Quiz</option>
        <option value="exercice" {{ old('type', $contenu->type ?? '') == 'exercice' ? 'selected' : '' }}>Exercice</option>
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

{{-- SECTION STOCKAGE --}}
<div class="form-group" id="storageTypeGroup" style="display: none;">
    <label for="storage_type">Type de stockage</label>
    <select name="storage_type" id="storage_type" class="form-control">
        <option value="local" {{ old('storage_type', $contenu->storage_type ?? 'local') == 'local' ? 'selected' : '' }}>📁 Stockage local (serveur)</option>
        <option value="google_drive" {{ old('storage_type', $contenu->storage_type ?? '') == 'google_drive' ? 'selected' : '' }}>☁️ Google Drive</option>
    </select>
    <small class="text-muted">Choisissez où stocker votre fichier</small>
</div>

{{-- SECTION URL VIDÉO EXTERNE --}}
<div class="form-group" id="videoUrlGroup" style="display: none;">
    <label for="video_url">URL de la vidéo (YouTube, Vimeo, Dailymotion, Google Drive)</label>
    <input type="url" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror" 
           placeholder="https://www.youtube.com/watch?v=..." 
           value="{{ old('video_url', $contenu->video_url ?? '') }}">
    <small class="text-muted">Laissez vide pour uploader un fichier vidéo</small>
    <div id="videoPreview" class="mt-2" style="display: none;">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" id="videoPreviewFrame" src=""></iframe>
        </div>
    </div>
    @error('video_url')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- SECTION UPLOAD FICHIER --}}
<div class="form-group" id="fileUploadGroup">
    <label for="fichier" id="fichierLabel">Fichier</label>
    @if(isset($contenu) && $contenu->fichier)
        <div class="mb-2">
            <span class="badge badge-info">
                <i class="fas fa-file"></i> Fichier actuel : {{ basename($contenu->fichier) }}
            </span>
            @if(isset($contenu->storage_type) && $contenu->storage_type == 'google_drive')
                <span class="badge badge-primary"><i class="fab fa-google-drive"></i> Stocké sur Google Drive</span>
            @endif
            <br>
            <small class="text-muted">Laissez vide pour conserver le fichier actuel</small>
        </div>
    @endif
    <input type="file" name="fichier" id="fichier" 
           class="form-control-file @error('fichier') is-invalid @enderror"
           accept=".mp4,.webm,.ogg,.mov,.avi,.mkv,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.svg,.mp3,.wav,.zip">
    <small class="form-text text-muted" id="fileHelp">Formats acceptés selon le type choisi. Max: 500 Mo</small>
    <div id="filePreview" class="mt-2" style="display: none;">
        <div class="alert alert-info">
            <i class="fas fa-spinner fa-spin"></i> Upload en cours...
        </div>
    </div>
    @error('fichier')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- SECTION DURÉE VIDÉO --}}
<div class="form-group" id="dureeVideoGroup" style="display: none;">
    <label for="duree_video">Durée de la vidéo (secondes)</label>
    <input type="number" name="duree_video" id="duree_video" class="form-control" 
           value="{{ old('duree_video', $contenu->duree_video ?? '') }}" 
           placeholder="Ex: 360 pour 6 minutes" min="0">
    <small class="text-muted">Optionnel - sera calculé automatiquement si possible</small>
</div>

{{-- SECTION CONTENU TEXTE --}}
<div class="text-content-section">
    <div class="form-group">
        <label for="contenu">Description / Contenu textuel</label>
        <textarea name="contenu" id="contenu" rows="10" 
                  class="form-control @error('contenu') is-invalid @enderror">{{ old('contenu', $contenu->contenu ?? '') }}</textarea>
        <small class="form-text text-muted">Description détaillée du contenu, transcriptions, instructions, etc.</small>
        @error('contenu')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- SECTION RESSOURCES SUPPLEMENTAIRES --}}
<div class="form-group" id="resourcesGroup" style="display: none;">
    <label for="ressources">Ressources supplémentaires (fichiers joints)</label>
    <input type="file" name="ressources[]" id="ressources" class="form-control-file" multiple 
           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
    <small class="text-muted">Fichiers supplémentaires (supports de cours, exercices, etc.)</small>
    @if(isset($contenu) && $contenu->ressources)
        <div class="mt-2">
            <strong>Ressources actuelles :</strong>
            <ul class="list-unstyled">
                @foreach(json_decode($contenu->ressources, true) ?? [] as $ressource)
                <li><i class="fas fa-paperclip"></i> {{ basename($ressource) }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

{{-- SECTION APERÇU VIDÉO --}}
<div class="form-group" id="videoApercuGroup" style="display: none;">
    <label>Aperçu de la vidéo</label>
    <div id="videoApercu" class="bg-dark rounded p-2 text-center">
        <i class="fas fa-video fa-3x text-muted"></i>
        <p class="text-muted mt-2">Aucune vidéo sélectionnée</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
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
    <div class="col-md-4">
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
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="gratuit" id="gratuit" class="custom-control-input" 
                       value="1" {{ old('gratuit', $contenu->gratuit ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="gratuit">
                    <i class="fas fa-gift"></i> Contenu gratuit
                </label>
            </div>
            <small class="form-text text-muted">Accessible sans inscription</small>
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
        
        // Fonction pour extraire l'ID YouTube
        function getYouTubeId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }
        
        // Fonction pour extraire l'ID Vimeo
        function getVimeoId(url) {
            const regExp = /(?:vimeo)\.com.*?(?:video\/|embed\/|channels\/.+?\/|)(\d+)/;
            const match = url.match(regExp);
            return match ? match[1] : null;
        }
        
        // Aperçu de la vidéo URL
        $('#video_url').on('change keyup', function() {
            var url = $(this).val();
            var embedUrl = '';
            
            if (url.includes('youtube.com') || url.includes('youtu.be')) {
                var videoId = getYouTubeId(url);
                if (videoId) embedUrl = 'https://www.youtube.com/embed/' + videoId;
            } else if (url.includes('vimeo.com')) {
                var videoId = getVimeoId(url);
                if (videoId) embedUrl = 'https://player.vimeo.com/video/' + videoId;
            } else if (url.includes('drive.google.com')) {
                var fileId = url.match(/[-\w]{25,}/);
                if (fileId) embedUrl = 'https://drive.google.com/file/d/' + fileId[0] + '/preview';
            }
            
            if (embedUrl) {
                $('#videoPreviewFrame').attr('src', embedUrl);
                $('#videoPreview').show();
            } else {
                $('#videoPreview').hide();
            }
        });
        
        // Gestion de l'affichage selon le type
        function updateFormByType() {
            var type = $('#type').val();
            
            // Réinitialiser l'affichage
            $('.file-upload-section').show();
            $('.text-content-section').show();
            $('#storageTypeGroup').hide();
            $('#videoUrlGroup').hide();
            $('#resourcesGroup').hide();
            $('#dureeVideoGroup').hide();
            $('#videoApercuGroup').hide();
            
            if (type === 'video' || type === 'tutoriel') {
                // Types vidéo
                $('#storageTypeGroup').show();
                $('#videoUrlGroup').show();
                $('#dureeVideoGroup').show();
                $('#videoApercuGroup').show();
                $('#fichierLabel').html('Fichier vidéo');
                $('#fileHelp').html('Formats vidéo: MP4, WebM, OGG, MOV, AVI. Max: 500 Mo');
                $('#fichier').attr('accept', '.mp4,.webm,.ogg,.mov,.avi,.mkv');
                $('#contenu').prop('required', false);
                $('#fichier').prop('required', false);
                $('#video_url').prop('required', false);
                
            } else if (type === 'document') {
                // Types document
                $('#storageTypeGroup').show();
                $('#fichierLabel').html('Fichier document');
                $('#fileHelp').html('Formats: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Max: 50 Mo');
                $('#fichier').attr('accept', '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx');
                $('#contenu').prop('required', false);
                $('#fichier').prop('required', false);
                $('.text-content-section').hide();
                
            } else if (type === 'image') {
                // Types image
                $('#storageTypeGroup').show();
                $('#fichierLabel').html('Fichier image');
                $('#fileHelp').html('Formats: JPG, JPEG, PNG, GIF, SVG. Max: 10 Mo');
                $('#fichier').attr('accept', '.jpg,.jpeg,.png,.gif,.svg');
                $('#contenu').prop('required', false);
                $('.text-content-section').hide();
                
            } else if (type === 'audio') {
                // Types audio
                $('#storageTypeGroup').show();
                $('#fichierLabel').html('Fichier audio');
                $('#fileHelp').html('Formats: MP3, WAV, OGG, M4A. Max: 50 Mo');
                $('#fichier').attr('accept', '.mp3,.wav,.ogg,.m4a');
                $('#contenu').prop('required', false);
                $('.text-content-section').hide();
                
            } else if (type === 'quiz' || type === 'exercice') {
                // Types interactifs
                $('#resourcesGroup').show();
                $('#contenu').prop('required', true);
                $('#fichier').prop('required', false);
                $('.file-upload-section').hide();
                $('#storageTypeGroup').hide();
                $('#fileHelp').html('Contenu textuel obligatoire');
            }
        }
        
        // Gestion du changement de type de stockage
        $('#storage_type').on('change', function() {
            var storageType = $(this).val();
            if (storageType === 'google_drive') {
                $('#fileHelp').append(' <span class="badge badge-primary">Stockage Google Drive</span>');
            }
        });
        
        // Aperçu du fichier sélectionné
        $('#fichier').on('change', function() {
            var file = this.files[0];
            var type = $('#type').val();
            
            if (file) {
                var sizeMB = file.size / 1024 / 1024;
                var maxSize = (type === 'video') ? 500 : (type === 'document' ? 50 : (type === 'audio' ? 50 : 10));
                
                if (sizeMB > maxSize) {
                    Swal.fire('Erreur', `Le fichier dépasse ${maxSize} Mo`, 'error');
                    $(this).val('');
                    return;
                }
                
                // Aperçu pour les vidéos
                if (type === 'video' && file.type.startsWith('video/')) {
                    var videoUrl = URL.createObjectURL(file);
                    $('#videoApercu').html(`
                        <video controls class="w-100" style="max-height: 200px;">
                            <source src="${videoUrl}" type="${file.type}">
                        </video>
                    `);
                    $('#videoApercuGroup').show();
                } else if (type === 'image' && file.type.startsWith('image/')) {
                    var imgUrl = URL.createObjectURL(file);
                    $('#videoApercu').html(`
                        <img src="${imgUrl}" class="img-fluid rounded" style="max-height: 200px;">
                    `);
                    $('#videoApercuGroup').show();
                }
                
                $('#filePreview').show();
            }
        });
        
        // Initialisation
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

<style>
    .select2-container--bootstrap4 .select2-selection {
        min-height: calc(2.25rem + 2px);
    }
    .video-preview {
        background: #000;
        border-radius: 8px;
        overflow: hidden;
    }
    .file-info {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        margin-top: 10px;
    }
</style>