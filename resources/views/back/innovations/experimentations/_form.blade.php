<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre', $experimentation->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Innovation liée</label>
        <select name="innovation_id" class="form-select hub-input">
            <option value="">Aucune</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $experimentation->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Responsable</label>
        <select name="responsable_id" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('responsable_id', $experimentation->responsable_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date début</label>
        <input type="date" name="date_debut" class="form-control hub-input"
               value="{{ old('date_debut', optional($experimentation->date_debut ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date fin</label>
        <input type="date" name="date_fin" class="form-control hub-input"
               value="{{ old('date_fin', optional($experimentation->date_fin ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['planifiee','en_cours','terminee','suspendue','abandonnee'] as $s)
                <option value="{{ $s }}" @selected(old('statut', $experimentation->statut ?? 'planifiee') === $s)>
                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Hypothèse testée</label>
        <textarea name="hypothese" rows="4" class="form-control rounded-4">{{ old('hypothese', $experimentation->hypothese ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Protocole</label>
        <textarea name="protocole" rows="5" class="form-control rounded-4">{{ old('protocole', $experimentation->protocole ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="5" class="form-control rounded-4">{{ old('description', $experimentation->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Résultat global</label>
        <textarea name="resultat_global" rows="4" class="form-control rounded-4">{{ old('resultat_global', $experimentation->resultat_global ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.experimentations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
    </div>

</div>
