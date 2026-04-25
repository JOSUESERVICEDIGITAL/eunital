<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Réforme liée</label>
        <select name="reforme_interne_id" class="form-select hub-input" required>
            <option value="">Sélectionner</option>
            @foreach($reformes as $reforme)
                <option value="{{ $reforme->id }}" @selected(old('reforme_interne_id', $action->reforme_interne_id ?? '') == $reforme->id)>
                    {{ $reforme->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Responsable</label>
        <select name="responsable_id" class="form-select hub-input">
            <option value="">Aucun</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('responsable_id', $action->responsable_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-8">
        <label class="form-label fw-bold">Titre de l’action</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre', $action->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input" required>
            @foreach(['a_faire','en_cours','realisee','bloquee'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $action->statut ?? 'a_faire') === $statut)>
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Date début</label>
        <input type="date" name="date_debut" class="form-control hub-input"
               value="{{ old('date_debut', optional($action->date_debut ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Date échéance</label>
        <input type="date" name="date_echeance" class="form-control hub-input"
               value="{{ old('date_echeance', optional($action->date_echeance ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="6" class="form-control rounded-4">{{ old('description', $action->description ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.actions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>

</div>
