<div class="form-group">
    <label for="cour_id">Cours <span class="text-danger">*</span></label>
    <select name="cour_id" id="cour_id"
            class="form-control select2 @error('cour_id') is-invalid @enderror" required>
        <option value="">Sélectionner un cours</option>
        @foreach($cours as $courItem)
            <option value="{{ $courItem->id }}"
                    data-module="{{ $courItem->module->titre ?? 'N/A' }}"
                    {{ old('cour_id', $accesSalle->cour_id ?? '') == $courItem->id ? 'selected' : '' }}>
                {{ $courItem->titre }} ({{ $courItem->module->titre ?? 'N/A' }})
            </option>
        @endforeach
    </select>
    @error('cour_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="alert alert-info" id="courInfo" style="display:none;">
    <i class="fas fa-info-circle mr-1"></i>
    <strong>Module lié :</strong> <span id="moduleCourInfo">N/A</span>
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
    <small class="form-text text-muted">Laissez vide pour générer automatiquement.</small>
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
            <small class="form-text text-muted">Laissez vide pour illimité.</small>
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
            <small class="form-text text-muted">Vide = illimité.</small>
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

<div class="alert alert-warning" id="expirationWarning" style="display:none;">
    <i class="fas fa-exclamation-triangle mr-1"></i>
    <strong>Attention :</strong> la date choisie est déjà passée.
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cour_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un cours',
            allowClear: true,
            width: '100%'
        });

        function updateCourInfo() {
            const selected = $('#cour_id').find('option:selected');
            if (selected.val()) {
                $('#moduleCourInfo').text(selected.data('module') || 'N/A');
                $('#courInfo').slideDown(150);
            } else {
                $('#courInfo').slideUp(150);
            }
        }

        function checkExpiration() {
            const expiresAt = $('#expires_at').val();
            if (!expiresAt) {
                $('#expirationWarning').hide();
                return;
            }

            const expireDate = new Date(expiresAt);
            const now = new Date();

            if (expireDate < now) {
                $('#expirationWarning').show();
            } else {
                $('#expirationWarning').hide();
            }
        }

        $('#cour_id').on('change', updateCourInfo);
        $('#expires_at').on('change', checkExpiration);

        updateCourInfo();
        checkExpiration();
    });

    function genererCode() {
        const code = Math.random().toString(36).substring(2, 10).toUpperCase();
        $('#code_acces').val(code);

        Swal.fire({
            icon: 'success',
            title: 'Code généré',
            text: 'Code : ' + code,
            timer: 1800,
            showConfirmButton: false
        });
    }
</script>
@endpush
