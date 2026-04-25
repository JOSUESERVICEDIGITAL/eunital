<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Innovation</label>
        <select name="innovation_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $suivi->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Date suivi</label>
        <input type="date" name="date_suivi" class="form-control hub-input"
               value="{{ old('date_suivi', optional($suivi->date_suivi ?? now())->format('Y-m-d')) }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Progression (%)</label>
        <input type="number" name="progression" min="0" max="100" class="form-control hub-input"
               value="{{ old('progression', $suivi->progression ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Statut global</label>
        <input type="text" name="statut_global" class="form-control hub-input"
               value="{{ old('statut_global', $suivi->statut_global ?? '') }}"
               placeholder="Ex: conforme, en retard, à risque..." required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Rédigé par</label>
        <select name="redige_par" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('redige_par', $suivi->redige_par ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Résumé</label>
        <textarea name="resume" rows="5" class="form-control rounded-4">{{ old('resume', $suivi->resume ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Risques majeurs</label>
        <textarea name="risques_majeurs" rows="4" class="form-control rounded-4">{{ old('risques_majeurs', $suivi->risques_majeurs ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Recommandations</label>
        <textarea name="recommandations" rows="4" class="form-control rounded-4">{{ old('recommandations', $suivi->recommandations ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.suivis.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
    </div>

</div>
