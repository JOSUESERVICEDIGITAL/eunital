<div class="form-group">
    <label for="cour_id">Cours <span class="text-danger">*</span></label>
    <select name="cour_id" id="cour_id" 
            class="form-control select2 @error('cour_id') is-invalid @enderror" required>
        <option value="">Sélectionner un cours</option>
        @foreach($cours as $courItem)
        <option value="{{ $courItem->id }}" 
            {{ old('cour_id', $accesSalle->cour_id ?? '') == $courItem->id ? 'selected' : '' }}>
            {{ $courItem->titre }} ({{ $courItem->module->titre ?? 'N/A' }})
        </option>
        @endforeach
    </select>
    @error('cour_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="code_acces">Code d'accès</label>
    <div class="input-group">
        <input type="text" name="code_acces" id="code_acces" 
               class="form-control @error('code_acces') is-invalid @enderror" 
               value="{{ old('code_acces', $accesSalle->code_acces ?? '') }}">
        <div class="input-group-append">
            <button type="button" class="btn btn-secondary" onclick="genererCode()">
                <i class="fas fa-sync-alt"></i> Générer
            </button>
        </div>
    </div>
    <small class="form-text text-muted">Laissez vide pour générer automatiquement un code aléatoire</small>
    @error('code_acces')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="expires_at">Date d'expiration</label>
            <input type="datetime-local" name="expires_at" id="expires_at" 
                   class="form-control @error('expires_at') is-invalid @enderror" 
                   value="{{ old('expires_at', isset($accesSalle) && $accesSalle->expires_at ? \Carbon\Carbon::parse($accesSalle->expires_at)->format('Y-m-d\TH:i') : '') }}">
            <small class="form-text text-muted">Laissez vide pour une durée illimitée</small>
            @error('expires_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="max_utilisateurs">Nombre max d'utilisateurs</label>
            <input type="number" name="max_utilisateurs" id="max_utilisateurs" 
                   class="form-control @error('max_utilisateurs') is-invalid @enderror" 
                   value="{{ old('max_utilisateurs', $accesSalle->max_utilisateurs ?? '') }}" 
                   min="1">
            <small class="form-text text-muted">Laissez vide pour illimité</small>
            @error('max_utilisateurs')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="is_active">Statut</label>
    <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
        <option value="1" {{ old('is_active', $accesSalle->is_active ?? true) ? 'selected' : '' }}>Actif</option>
        <option value="0" {{ old('is_active', $accesSalle->is_active ?? true) ? '' : 'selected' }}>Inactif</option>
    </select>
    @error('is_active')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="alert alert-warning" id="expirationWarning" style="display: none;">
    <i class="fas fa-exclamation-triangle"></i>
    <strong>Attention :</strong> Un code expiré ne pourra plus être utilisé pour accéder à la salle.
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Select2 pour le cours
        $('#cour_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un cours',
            allowClear: true
        });
        
        // Afficher un avertissement si la date d'expiration est dans le passé
        function checkExpiration() {
            var expiresAt = $('#expires_at').val();
            if (expiresAt) {
                var expireDate = new Date(expiresAt);
                var now = new Date();
                if (expireDate < now) {
                    $('#expirationWarning').show();
                } else {
                    $('#expirationWarning').hide();
                }
            } else {
                $('#expirationWarning').hide();
            }
        }
        
        $('#expires_at').on('change', checkExpiration);
        checkExpiration();
        
        // Si un cours est sélectionné, afficher des informations supplémentaires
        $('#cour_id').on('change', function() {
            var selected = $(this).find('option:selected');
            if (selected.val()) {
                // Optionnel: charger des informations supplémentaires via AJAX
            }
        });
    });
    
    function genererCode() {
        var code = Math.random().toString(36).substring(2, 10).toUpperCase();
        $('#code_acces').val(code);
        Swal.fire({
            icon: 'success',
            title: 'Code généré',
            text: 'Code: ' + code,
            timer: 2000,
            showConfirmButton: false
        });
    }
</script>
@endpush