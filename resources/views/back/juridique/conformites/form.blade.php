<div class="form-group">
    <label for="legalite_id">Texte légal <span class="text-danger">*</span></label>
    <select name="legalite_id" id="legalite_id" class="form-control select2" required>
        <option value="">Sélectionner</option>
        @foreach($legalites as $legalite)
        <option value="{{ $legalite->id }}" {{ old('legalite_id', $conformite->legalite_id ?? '') == $legalite->id ? 'selected' : '' }}>{{ $legalite->titre }} ({{ $legalite->type_label }})</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="entreprise_id">Entreprise</label>
    <select name="entreprise_id" id="entreprise_id" class="form-control select2">
        <option value="">Aucune</option>
        @foreach($entreprises as $entreprise)
        <option value="{{ $entreprise->id }}" {{ old('entreprise_id', $conformite->entreprise_id ?? '') == $entreprise->id ? 'selected' : '' }}>{{ $entreprise->nom }} ({{ $entreprise->siret_formate ?? $entreprise->siret }})</option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="en_cours" {{ old('statut', $conformite->statut ?? 'en_cours') == 'en_cours' ? 'selected' : '' }}>En cours d'évaluation</option>
                <option value="conforme" {{ old('statut', $conformite->statut ?? '') == 'conforme' ? 'selected' : '' }}>Conforme</option>
                <option value="non_conforme" {{ old('statut', $conformite->statut ?? '') == 'non_conforme' ? 'selected' : '' }}>Non conforme</option>
                <option value="partiellement_conforme" {{ old('statut', $conformite->statut ?? '') == 'partiellement_conforme' ? 'selected' : '' }}>Partiellement conforme</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="score_conformite">Score (%)</label>
            <input type="number" name="score_conformite" id="score_conformite" class="form-control" value="{{ old('score_conformite', $conformite->score_conformite ?? '') }}" min="0" max="100" step="1">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_controle">Date du contrôle</label>
            <input type="date" name="date_controle" id="date_controle" class="form-control" value="{{ old('date_controle', isset($conformite) && $conformite->date_controle ? $conformite->date_controle->format('Y-m-d') : '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_prochaine_evaluation">Date prochaine évaluation</label>
            <input type="date" name="date_prochaine_evaluation" id="date_prochaine_evaluation" class="form-control" value="{{ old('date_prochaine_evaluation', isset($conformite) && $conformite->date_prochaine_evaluation ? $conformite->date_prochaine_evaluation->format('Y-m-d') : '') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="commentaires">Commentaires</label>
    <textarea name="commentaires" id="commentaires" rows="3" class="form-control">{{ old('commentaires', $conformite->commentaires ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="evaluations">Évaluations détaillées (JSON)</label>
    <textarea name="evaluations" id="evaluations" rows="6" class="form-control font-monospace">{{ old('evaluations', isset($conformite) && $conformite->evaluations ? json_encode($conformite->evaluations, JSON_PRETTY_PRINT) : '') }}</textarea>
    <small class="text-muted">Format: [{"critere":"Nom du critère","statut":"conforme/non_conforme","commentaire":"..."}]</small>
</div>

<div class="form-group">
    <label for="actions_correctives">Actions correctives (JSON)</label>
    <textarea name="actions_correctives" id="actions_correctives" rows="6" class="form-control font-monospace">{{ old('actions_correctives', isset($conformite) && $conformite->actions_correctives ? json_encode($conformite->actions_correctives, JSON_PRETTY_PRINT) : '') }}</textarea>
    <small class="text-muted">Format: [{"action":"Description","responsable":"Nom","date_limite":"YYYY-MM-DD","statut":"en_cours/termine"}]</small>
</div>

<div class="form-group">
    <label for="preuves">Preuves (JSON)</label>
    <textarea name="preuves" id="preuves" rows="3" class="form-control font-monospace">{{ old('preuves', isset($conformite) && $conformite->preuves ? json_encode($conformite->preuves, JSON_PRETTY_PRINT) : '') }}</textarea>
</div>

@push('juridique-scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#legalite_id, #entreprise_id').select2({ theme: 'bootstrap4', placeholder: 'Sélectionner', allowClear: true });
    $('#score_conformite').on('change', function() {
        var score = $(this).val();
        if (score >= 80) $('#statut').val('conforme');
        else if (score >= 60) $('#statut').val('partiellement_conforme');
        else if (score > 0) $('#statut').val('non_conforme');
    });
    $('#date_controle').on('change', function() {
        if ($('#date_prochaine_evaluation').val() === '') {
            var date = $(this).val();
            if (date) { var d = new Date(date); d.setFullYear(d.getFullYear() + 1); $('#date_prochaine_evaluation').val(d.toISOString().split('T')[0]); }
        }
    });
</script>
@endpush