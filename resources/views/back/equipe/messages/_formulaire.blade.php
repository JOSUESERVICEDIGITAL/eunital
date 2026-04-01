<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Expéditeur</label>
        <select name="expediteur_id" class="form-select form-select-lg rounded-4">
            @foreach($membres as $membre)
                <option value="{{ $membre->id }}" @selected(old('expediteur_id', $messageInterne->expediteur_id ?? '') == $membre->id)>
                    {{ $membre->nom }} {{ $membre->prenom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Destinataire</label>
        <select name="destinataire_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun destinataire direct</option>
            @foreach($membres as $membre)
                <option value="{{ $membre->id }}" @selected(old('destinataire_id', $messageInterne->destinataire_id ?? '') == $membre->id)>
                    {{ $membre->nom }} {{ $membre->prenom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Département concerné</label>
        <select name="departement_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun</option>
            @foreach($departements as $departement)
                <option value="{{ $departement->id }}" @selected(old('departement_id', $messageInterne->departement_id ?? '') == $departement->id)>
                    {{ $departement->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de message</label>
        <select name="type_message" class="form-select form-select-lg rounded-4">
            <option value="direct" @selected(old('type_message', $messageInterne->type_message ?? 'direct') === 'direct')>Direct</option>
            <option value="annonce" @selected(old('type_message', $messageInterne->type_message ?? '') === 'annonce')>Annonce</option>
            <option value="service" @selected(old('type_message', $messageInterne->type_message ?? '') === 'service')>Service</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Sujet</label>
        <input type="text" name="sujet" class="form-control form-control-lg rounded-4 @error('sujet') is-invalid @enderror"
            value="{{ old('sujet', $messageInterne->sujet ?? '') }}">
        @error('sujet')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Contenu</label>
        <textarea name="contenu" rows="7" class="form-control rounded-4 @error('contenu') is-invalid @enderror">{{ old('contenu', $messageInterne->contenu ?? '') }}</textarea>
        @error('contenu')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date d’envoi</label>
        <input type="datetime-local" name="date_envoi" class="form-control form-control-lg rounded-4"
            value="{{ old('date_envoi', isset($messageInterne->date_envoi) ? $messageInterne->date_envoi->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div class="col-md-6">
        <div class="form-check form-switch mt-5">
            <input class="form-check-input" type="checkbox" role="switch" name="est_lu" value="1"
                @checked(old('est_lu', $messageInterne->est_lu ?? false))>
            <label class="form-check-label">Déjà marqué comme lu</label>
        </div>
    </div>
</div>