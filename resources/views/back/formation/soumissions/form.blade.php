<div class="form-group">
    <label for="devoir_id">Devoir <span class="text-danger">*</span></label>
    <select name="devoir_id" id="devoir_id" 
            class="form-control select2 @error('devoir_id') is-invalid @enderror" required>
        <option value="">Sélectionner un devoir</option>
        @foreach($devoirs as $devoirItem)
        <option value="{{ $devoirItem->id }}" 
            {{ old('devoir_id', $soumission->devoir_id ?? '') == $devoirItem->id ? 'selected' : '' }}
            data-date-limite="{{ $devoirItem->date_limite }}"
            data-note-max="{{ $devoirItem->note_maximale }}">
            {{ $devoirItem->titre }} ({{ $devoirItem->cour->titre }}) - {{ $devoirItem->type }}
            @if($devoirItem->date_limite)
                - jusqu'au {{ \Carbon\Carbon::parse($devoirItem->date_limite)->format('d/m/Y H:i') }}
            @endif
        </option>
        @endforeach
    </select>
    @error('devoir_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group" id="devoirInfo" style="display: none;">
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Informations du devoir :</strong>
        <ul class="mb-0 mt-2">
            <li>Note maximale : <span id="noteMax">-</span></li>
            <li>Date limite : <span id="dateLimite">-</span></li>
            <li>Statut : <span id="statutLimite">-</span></li>
        </ul>
    </div>
</div>

<div class="form-group">
    <label for="contenu">Commentaire (optionnel)</label>
    <textarea name="contenu" id="contenu" rows="4" 
              class="form-control @error('contenu') is-invalid @enderror">{{ old('contenu', $soumission->contenu ?? '') }}</textarea>
    <small class="form-text text-muted">Ajoutez un commentaire pour l'enseignant</small>
    @error('contenu')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="fichiers">Fichiers joints</label>
    <input type="file" name="fichiers[]" id="fichiers" 
           class="form-control-file @error('fichiers') is-invalid @enderror" 
           multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.zip,.rar">
    <small class="form-text text-muted">
        Formats acceptés : PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, ZIP, RAR.<br>
        Taille maximale : 20 Mo par fichier.
    </small>
    @if(isset($soumission) && $soumission->fichiers)
        <div class="mt-2">
            <strong>Fichiers actuels :</strong>
            <ul class="list-unstyled">
                @foreach($soumission->fichiers as $index => $fichier)
                <li>
                    <i class="fas fa-file-alt text-primary"></i>
                    {{ $fichier['name'] }}
                    <a href="{{ route('back.formation.soumissions.telecharger-fichier', [$soumission, $index]) }}" class="btn btn-sm btn-link" target="_blank">
                        <i class="fas fa-download"></i>
                    </a>
                </li>
                @endforeach
            </ul>
            <small class="text-muted">Laissez vide pour conserver les fichiers actuels</small>
        </div>
    @endif
    @error('fichiers')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2 pour le devoir
        $('#devoir_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un devoir',
            allowClear: true
        });
        
        // Afficher les informations du devoir
        $('#devoir_id').on('change', function() {
            var selected = $(this).find('option:selected');
            var dateLimite = selected.data('date-limite');
            var noteMax = selected.data('note-max');
            
            if (selected.val()) {
                $('#noteMax').text(noteMax || '-');
                
                if (dateLimite) {
                    var date = new Date(dateLimite);
                    $('#dateLimite').text(date.toLocaleString('fr-FR'));
                    
                    var maintenant = new Date();
                    if (date < maintenant) {
                        $('#statutLimite').html('<span class="badge badge-danger">Expiré</span>');
                    } else {
                        $('#statutLimite').html('<span class="badge badge-warning">En cours</span>');
                    }
                } else {
                    $('#dateLimite').text('Aucune limite');
                    $('#statutLimite').html('<span class="badge badge-success">Illimité</span>');
                }
                
                $('#devoirInfo').show();
            } else {
                $('#devoirInfo').hide();
            }
        });
        
        // Déclencher au chargement
        if ($('#devoir_id').val()) {
            $('#devoir_id').trigger('change');
        }
        
        // Validation des fichiers
        $('#fichiers').on('change', function() {
            var files = this.files;
            var maxSize = 20 * 1024 * 1024; // 20 MB
            var validTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'zip', 'rar'];
            
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var extension = file.name.split('.').pop().toLowerCase();
                
                if (file.size > maxSize) {
                    Swal.fire('Erreur', 'Le fichier "' + file.name + '" dépasse la taille maximale de 20 Mo', 'error');
                    $(this).val('');
                    return false;
                }
                
                if (validTypes.indexOf(extension) === -1) {
                    Swal.fire('Erreur', 'Le fichier "' + file.name + '" a un format non autorisé', 'error');
                    $(this).val('');
                    return false;
                }
            }
        });
    });
</script>
@endpush