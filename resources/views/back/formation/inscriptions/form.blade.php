<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="user_id">Étudiant <span class="text-danger">*</span></label>
            <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required>
                <option value="">Sélectionner un étudiant</option>
                @foreach($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->id }}" {{ old('user_id', $inscription->user_id ?? '') == $utilisateur->id ? 'selected' : '' }}>
                        {{ $utilisateur->name }} ({{ $utilisateur->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="module_id">Module <span class="text-danger">*</span></label>
            <select name="module_id" id="module_id" class="form-control select2 @error('module_id') is-invalid @enderror" required>
                <option value="">Sélectionner un module</option>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}"
                            {{ old('module_id', $inscription->module_id ?? '') == $module->id ? 'selected' : '' }}
                            data-cours="{{ $module->cours->count() }}"
                            data-categorie="{{ $module->categorie->nom ?? 'N/A' }}">
                        {{ $module->titre }} ({{ $module->categorie->nom ?? 'N/A' }}) - {{ $module->cours->count() }} cours
                    </option>
                @endforeach
            </select>
            @error('module_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="alert alert-info" id="moduleInfo" style="display:none;">
    <i class="fas fa-info-circle mr-1"></i>
    <strong>Infos module :</strong>
    <ul class="mb-0 mt-2">
        <li>Nombre de cours : <span id="nbCours">0</span></li>
        <li>Catégorie : <span id="categorieModule">N/A</span></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control @error('statut') is-invalid @enderror">
                <option value="en_attente" {{ old('statut', $inscription->statut ?? 'en_attente') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="valide" {{ old('statut', $inscription->statut ?? '') == 'valide' ? 'selected' : '' }}>Validé</option>
                <option value="termine" {{ old('statut', $inscription->statut ?? '') == 'termine' ? 'selected' : '' }}>Terminé</option>
                <option value="abandonne" {{ old('statut', $inscription->statut ?? '') == 'abandonne' ? 'selected' : '' }}>Abandonné</option>
            </select>
            @error('statut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="progression">Progression (%)</label>
            <input type="number" name="progression" id="progression"
                   class="form-control @error('progression') is-invalid @enderror"
                   value="{{ old('progression', $inscription->progression ?? 0) }}"
                   min="0" max="100" step="1">
            @error('progression')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button type="button" class="btn btn-outline-primary btn-block" id="setTodayBtn">
            <i class="fas fa-calendar-day mr-1"></i> Mettre début aujourd’hui
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" id="date_debut"
                   class="form-control @error('date_debut') is-invalid @enderror"
                   value="{{ old('date_debut', isset($inscription) && $inscription->date_debut ? \Carbon\Carbon::parse($inscription->date_debut)->format('Y-m-d') : '') }}">
            @error('date_debut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin"
                   class="form-control @error('date_fin') is-invalid @enderror"
                   value="{{ old('date_fin', isset($inscription) && $inscription->date_fin ? \Carbon\Carbon::parse($inscription->date_fin)->format('Y-m-d') : '') }}">
            @error('date_fin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="derniere_activite">Dernière activité</label>
    <input type="datetime-local" name="derniere_activite" id="derniere_activite"
           class="form-control @error('derniere_activite') is-invalid @enderror"
           value="{{ old('derniere_activite', isset($inscription) && $inscription->derniere_activite ? \Carbon\Carbon::parse($inscription->derniere_activite)->format('Y-m-d\TH:i') : '') }}">
    @error('derniere_activite')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="metadatas">Métadonnées (JSON)</label>
    <textarea name="metadatas" id="metadatas" rows="3"
              class="form-control @error('metadatas') is-invalid @enderror"
              placeholder='{"note":"Information supplémentaire"}'>{{ old('metadatas', isset($inscription) && $inscription->metadatas ? json_encode($inscription->metadatas, JSON_PRETTY_PRINT) : '') }}</textarea>
    <small class="form-text text-muted">Format JSON valide.</small>
    @error('metadatas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_id, #module_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner une option',
            allowClear: true,
            width: '100%'
        });

        $('#module_id').on('change', function() {
            const selected = $(this).find('option:selected');
            if (selected.val()) {
                $('#nbCours').text(selected.data('cours') || 0);
                $('#categorieModule').text(selected.data('categorie') || 'N/A');
                $('#moduleInfo').slideDown(150);
            } else {
                $('#moduleInfo').slideUp(150);
            }
        });

        if ($('#module_id').val()) {
            $('#module_id').trigger('change');
        }

        $('#date_fin').on('change', function() {
            const debut = $('#date_debut').val();
            const fin = $(this).val();

            if (debut && fin && fin < debut) {
                $(this).val('');
                Swal.fire({
                    icon: 'error',
                    title: 'Date invalide',
                    text: 'La date de fin ne peut pas être antérieure à la date de début.'
                });
            }
        });

        $('#metadatas').on('change', function() {
            const value = $(this).val();
            if (value && value.trim() !== '') {
                try {
                    JSON.parse(value);
                    $(this).removeClass('is-invalid');
                } catch (e) {
                    $(this).addClass('is-invalid');
                    Swal.fire({
                        icon: 'error',
                        title: 'JSON invalide',
                        text: 'Le format JSON n’est pas valide.'
                    });
                }
            }
        });

        $('#progression').on('change', function() {
            if ($(this).val() == 100 && $('#statut').val() !== 'termine') {
                Swal.fire({
                    title: 'Progression complète',
                    text: 'Voulez-vous marquer cette inscription comme terminée ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, terminer',
                    cancelButtonText: 'Non'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#statut').val('termine');
                    }
                });
            }
        });

        $('#setTodayBtn').on('click', function() {
            const today = new Date().toISOString().split('T')[0];
            $('#date_debut').val(today);
        });
    });
</script>
@endpush
