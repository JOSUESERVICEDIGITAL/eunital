<div class="row g-4">
    <div class="col-md-6">
        <label for="name" class="form-label fw-semibold">Nom complet</label>
        <input type="text"
               name="name"
               id="name"
               class="form-control form-control-lg rounded-4 @error('name') is-invalid @enderror"
               value="{{ old('name', $utilisateur->name ?? '') }}"
               placeholder="Nom complet">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
        <input type="email"
               name="email"
               id="email"
               class="form-control form-control-lg rounded-4 @error('email') is-invalid @enderror"
               value="{{ old('email', $utilisateur->email ?? '') }}"
               placeholder="Adresse e-mail">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="telephone" class="form-label fw-semibold">Téléphone</label>
        <input type="text"
               name="telephone"
               id="telephone"
               class="form-control form-control-lg rounded-4 @error('telephone') is-invalid @enderror"
               value="{{ old('telephone', $utilisateur->telephone ?? '') }}"
               placeholder="Téléphone">
        @error('telephone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="photo" class="form-label fw-semibold">Photo</label>
        <input type="file"
               name="photo"
               id="photo"
               class="form-control form-control-lg rounded-4 @error('photo') is-invalid @enderror">
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label fw-semibold">Mot de passe</label>
        <input type="password"
               name="password"
               id="password"
               class="form-control form-control-lg rounded-4 @error('password') is-invalid @enderror"
               placeholder="Mot de passe">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="password_confirmation" class="form-label fw-semibold">Confirmation du mot de passe</label>
        <input type="password"
               name="password_confirmation"
               id="password_confirmation"
               class="form-control form-control-lg rounded-4"
               placeholder="Confirmer le mot de passe">
    </div>

    <div class="col-md-6">
        <label for="statut_compte" class="form-label fw-semibold">Statut du compte</label>
        <select name="statut_compte" id="statut_compte" class="form-select form-select-lg rounded-4 @error('statut_compte') is-invalid @enderror">
            <option value="actif" @selected(old('statut_compte', $utilisateur->statut_compte ?? 'actif') === 'actif')>Actif</option>
            <option value="inactif" @selected(old('statut_compte', $utilisateur->statut_compte ?? '') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(old('statut_compte', $utilisateur->statut_compte ?? '') === 'suspendu')>Suspendu</option>
        </select>
        @error('statut_compte')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="roles" class="form-label fw-semibold">Rôles</label>
        <select name="roles[]" id="roles" multiple class="form-select rounded-4 @error('roles') is-invalid @enderror">
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                    @selected(in_array($role->id, old('roles', isset($utilisateur) ? $utilisateur->roles->pluck('id')->toArray() : [])))>
                    {{ $role->nom }}
                </option>
            @endforeach
        </select>
        @error('roles')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="bio" class="form-label fw-semibold">Biographie</label>
        <textarea name="bio"
                  id="bio"
                  rows="5"
                  class="form-control rounded-4 @error('bio') is-invalid @enderror"
                  placeholder="Présentation courte de l’utilisateur...">{{ old('bio', $utilisateur->bio ?? '') }}</textarea>
        @error('bio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-check form-switch mt-2">
            <input class="form-check-input"
                   type="checkbox"
                   role="switch"
                   id="est_actif"
                   name="est_actif"
                   value="1"
                   @checked(old('est_actif', $utilisateur->est_actif ?? true))>
            <label class="form-check-label" for="est_actif">Compte activé</label>
        </div>
    </div>

    @if(isset($utilisateur) && $utilisateur->photo)
        <div class="col-12">
            <div class="existing-image-box">
                <span class="fw-semibold d-block mb-2">Photo actuelle</span>
                <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="{{ $utilisateur->name }}">
            </div>
        </div>
    @endif
</div>
