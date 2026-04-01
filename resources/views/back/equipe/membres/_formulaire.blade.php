<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Utilisateur lié</label>
        <select name="user_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun compte lié</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('user_id', $membreEquipe->user_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }} - {{ $utilisateur->email }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Photo</label>
        <input type="file" name="photo" class="form-control form-control-lg rounded-4 @error('photo') is-invalid @enderror">
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nom</label>
        <input type="text" name="nom" class="form-control form-control-lg rounded-4 @error('nom') is-invalid @enderror"
            value="{{ old('nom', $membreEquipe->nom ?? '') }}">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Prénom</label>
        <input type="text" name="prenom" class="form-control form-control-lg rounded-4 @error('prenom') is-invalid @enderror"
            value="{{ old('prenom', $membreEquipe->prenom ?? '') }}">
        @error('prenom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Email professionnel</label>
        <input type="email" name="email_professionnel" class="form-control form-control-lg rounded-4 @error('email_professionnel') is-invalid @enderror"
            value="{{ old('email_professionnel', $membreEquipe->email_professionnel ?? '') }}">
        @error('email_professionnel')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Téléphone</label>
        <input type="text" name="telephone" class="form-control form-control-lg rounded-4 @error('telephone') is-invalid @enderror"
            value="{{ old('telephone', $membreEquipe->telephone ?? '') }}">
        @error('telephone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Département</label>
        <select name="departement_id" class="form-select form-select-lg rounded-4">
            <option value="">Choisir</option>
            @foreach($departements as $departement)
                <option value="{{ $departement->id }}" @selected(old('departement_id', $membreEquipe->departement_id ?? '') == $departement->id)>
                    {{ $departement->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Poste</label>
        <select name="poste_id" class="form-select form-select-lg rounded-4">
            <option value="">Choisir</option>
            @foreach($postes as $poste)
                <option value="{{ $poste->id }}" @selected(old('poste_id', $membreEquipe->poste_id ?? '') == $poste->id)>
                    {{ $poste->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4">
            <option value="">Aucun</option>
            @foreach($responsables as $responsable)
                <option value="{{ $responsable->id }}" @selected(old('responsable_id', $membreEquipe->responsable_id ?? '') == $responsable->id)>
                    {{ $responsable->nom }} {{ $responsable->prenom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Date d’intégration</label>
        <input type="date" name="date_integration" class="form-control form-control-lg rounded-4"
            value="{{ old('date_integration', isset($membreEquipe->date_integration) ? $membreEquipe->date_integration->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="actif" @selected(old('statut', $membreEquipe->statut ?? 'actif') === 'actif')>Actif</option>
            <option value="inactif" @selected(old('statut', $membreEquipe->statut ?? '') === 'inactif')>Inactif</option>
            <option value="en_pause" @selected(old('statut', $membreEquipe->statut ?? '') === 'en_pause')>En pause</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Ordre organigramme</label>
        <input type="number" min="0" name="ordre_organigramme" class="form-control form-control-lg rounded-4"
            value="{{ old('ordre_organigramme', $membreEquipe->ordre_organigramme ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Biographie</label>
        <textarea name="bio" rows="5" class="form-control rounded-4">{{ old('bio', $membreEquipe->bio ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch" name="est_visible_organigramme" value="1"
                @checked(old('est_visible_organigramme', $membreEquipe->est_visible_organigramme ?? true))>
            <label class="form-check-label">Visible dans l’organigramme</label>
        </div>
    </div>

    @if(isset($membreEquipe) && $membreEquipe->photo)
        <div class="col-12">
            <div class="existing-image-box">
                <span class="fw-semibold d-block mb-2">Photo actuelle</span>
                <img src="{{ asset('storage/' . $membreEquipe->photo) }}" alt="{{ $membreEquipe->nom }}">
            </div>
        </div>
    @endif
</div>