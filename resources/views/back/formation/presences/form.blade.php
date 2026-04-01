<div class="form-group">
    <label for="inscription_id">Étudiant et module <span class="text-danger">*</span></label>
    <select name="inscription_id" id="inscription_id" 
            class="form-control select2 @error('inscription_id') is-invalid @enderror" required>
        <option value="">Sélectionner un étudiant</option>
        @foreach($inscriptions as $inscriptionItem)
        <option value="{{ $inscriptionItem->id }}" 
            {{ old('inscription_id', $presence->inscription_id ?? '') == $inscriptionItem->id ? 'selected' : '' }}
            data-user="{{ $inscriptionItem->user->name }}"
            data-module="{{ $inscriptionItem->module->titre }}">
            {{ $inscriptionItem->user->name }} - {{ $inscriptionItem->module->titre }}
        </option>
        @endforeach
    </select>
    @error('inscription_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="cour_id">Cours <span class="text-danger">*</span></label>
    <select name="cour_id" id="cour_id" 
            class="form-control @error('cour_id') is-invalid @enderror" required>
        <option value="">Sélectionner un cours</option>
        @foreach($cours as $courItem)
        <option value="{{ $courItem->id }}" 
            {{ old('cour_id', $presence->cour_id ?? '') == $courItem->id ? 'selected' : '' }}>
            {{ $courItem->titre }}
        </option>
        @endforeach
    </select>
    @error('cour_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_debut">Date et heure de début</label>
            <input type="datetime-local" name="date_debut" id="date_debut" 
                   class="form-control @error('date_debut') is-invalid @enderror" 
                   value="{{ old('date_debut', isset($presence) && $presence->date_debut ? \Carbon\Carbon::parse($presence->date_debut)->format('Y-m-d\TH:i') : '') }}">
            @error('date_debut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_fin">Date et heure de fin</label>
            <input type="datetime-local" name="date_fin" id="date_fin" 
                   class="form-control @error('date_fin') is-invalid @enderror" 
                   value="{{ old('date_fin', isset($presence) && $presence->date_fin ? \Carbon\Carbon::parse($presence->date_fin)->format('Y-m-d\TH:i') : '') }}">
            @error('date_fin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="present">Statut</label>
            <select name="present" id="present" class="form-control @error('present') is-invalid @enderror">
                <option value="1" {{ old('present', $presence->present ?? true) ? 'selected' : '' }}>Présent</option>
                <option value="0" {{ old('present', $presence->present ?? true) ? '' : 'selected' }}>Absent</option>
            </select>
            @error('present')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="statut">Statut détaillé</label>
            <select name="statut" id="statut" class="form-control @error('statut') is-invalid @enderror">
                <option value="present" {{ old('statut', $presence->statut ?? 'present') == 'present' ? 'selected' : '' }}>Présent</option>
                <option value="absent" {{ old('statut', $presence->statut ?? '') == 'absent' ? 'selected' : '' }}>Absent</option>
                <option value="retard" {{ old('statut', $presence->statut ?? '') == 'retard' ? 'selected' : '' }}>Retard</option>
                <option value="excusé" {{ old('statut', $presence->statut ?? '') == 'excusé' ? 'selected' : '' }}>Excusé</option>
            </select>
            @error('statut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="code_acces">Code d'accès</label>
            <div class="input-group">
                <input type="text" name="code_acces" id="code_acces" 
                       class="form-control @error('code_acces') is-invalid @enderror" 
                       value="{{ old('code_acces', $presence->code_acces ?? '') }}">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary" onclick="genererCode()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <small class="form-text text-muted">Code généré par l'enseignant pour accéder à la salle</small>
            @error('code_acces')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Select2 pour l'inscription
        $('#inscription_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner un étudiant',
            allowClear: true
        });
        
        // Calcul automatique de la durée
        function calculerDuree() {
            var dateDebut = $('#date_debut').val();
            var dateFin = $('#date_fin').val();
            
            if (dateDebut && dateFin) {
                var debut = new Date(dateDebut);
                var fin = new Date(dateFin);
                var duree = Math.floor((fin - debut) / 1000);
                
                if (duree > 0) {
                    $('#duree_connexion').val(duree);
                    var minutes = Math.floor(duree / 60);
                    var secondes = duree % 60;
                    $('#duree_affichage').text(minutes + ' min ' + secondes + ' sec');
                }
            }
        }
        
        $('#date_debut, #date_fin').on('change', calculerDuree);
        calculerDuree();
        
        // Si présent = oui, forcer statut à present si pas défini
        $('#present').on('change', function() {
            if ($(this).val() == '1' && $('#statut').val() == 'absent') {
                $('#statut').val('present');
            }
        });
        
        // Si statut = absent, forcer présent à non
        $('#statut').on('change', function() {
            if ($(this).val() == 'absent') {
                $('#present').val('0');
            } else if ($(this).val() == 'present') {
                $('#present').val('1');
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