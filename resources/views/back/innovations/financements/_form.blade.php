<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Innovation liée</label>
        <select name="innovation_id" class="form-select hub-input">
            <option value="">Aucune</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $financement->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Source de financement</label>
        <input type="text" name="source_financement" class="form-control hub-input"
               value="{{ old('source_financement', $financement->source_financement ?? '') }}"
               placeholder="Ex: budget interne, bailleur, partenaire, État..." required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Type de financement</label>
        <input type="text" name="type_financement" class="form-control hub-input"
               value="{{ old('type_financement', $financement->type_financement ?? '') }}"
               placeholder="Subvention, prêt, budget, dotation...">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Montant prévu</label>
        <input type="number" step="0.01" name="montant_prevu" class="form-control hub-input"
               value="{{ old('montant_prevu', $financement->montant_prevu ?? 0) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Montant obtenu</label>
        <input type="number" step="0.01" name="montant_obtenu" class="form-control hub-input"
               value="{{ old('montant_obtenu', $financement->montant_obtenu ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['en_attente','approuve','refuse','partiel'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $financement->statut ?? 'en_attente') === $statut)>
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Date d’approbation</label>
        <input type="date" name="date_approbation" class="form-control hub-input"
               value="{{ old('date_approbation', optional($financement->date_approbation ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.financements.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>

</div>
