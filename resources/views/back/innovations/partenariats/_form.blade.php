<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-bold">Innovation liée</label>
        <select name="innovation_id" class="form-select hub-input">
            <option value="">Aucune</option>
            @foreach($innovations as $innovation)
                <option value="{{ $innovation->id }}" @selected(old('innovation_id', $partenariat->innovation_id ?? '') == $innovation->id)>
                    {{ $innovation->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Nom du partenaire</label>
        <input type="text" name="nom_partenaire" class="form-control hub-input"
               value="{{ old('nom_partenaire', $partenariat->nom_partenaire ?? $partenariat->nom ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Type de partenaire</label>
        <select name="type_partenaire" class="form-select hub-input">
            @foreach(['institutionnel','technique','financier','operationnel','academique','prive','ong'] as $type)
                <option value="{{ $type }}" @selected(old('type_partenaire', $partenariat->type_partenaire ?? '') === $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input">
            @foreach(['actif','en_discussion','suspendu','termine'] as $statut)
                <option value="{{ $statut }}" @selected(old('statut', $partenariat->statut ?? 'actif') === $statut)>
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Contact</label>
        <input type="text" name="contact" class="form-control hub-input"
               value="{{ old('contact', $partenariat->contact ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control hub-input"
               value="{{ old('email', $partenariat->email ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Téléphone</label>
        <input type="text" name="telephone" class="form-control hub-input"
               value="{{ old('telephone', $partenariat->telephone ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Date début</label>
        <input type="date" name="date_debut" class="form-control hub-input"
               value="{{ old('date_debut', optional($partenariat->date_debut ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Date fin</label>
        <input type="date" name="date_fin" class="form-control hub-input"
               value="{{ old('date_fin', optional($partenariat->date_fin ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Contribution / rôle du partenaire</label>
        <textarea name="contribution" rows="6" class="form-control rounded-4">{{ old('contribution', $partenariat->contribution ?? '') }}</textarea>
    </div>

    <div class="col-12 d-flex flex-wrap gap-2">
        <button class="btn btn-warning rounded-pill px-4">
            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
        </button>
        <a href="{{ route('back.innovations.partenariats.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            Annuler
        </a>
    </div>

</div>
