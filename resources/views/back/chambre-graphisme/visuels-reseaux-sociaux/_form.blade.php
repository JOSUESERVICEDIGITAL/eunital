<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche visuel réseau social</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Titre</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $visuel->titre ?? '') }}"
                           placeholder="Ex : Post campagne, miniature vidéo, story événement...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Plateforme</label>
                    <select name="plateforme" class="form-select form-select-lg rounded-4 @error('plateforme') is-invalid @enderror">
                        <option value="facebook" @selected(old('plateforme', $visuel->plateforme ?? '') == 'facebook')>Facebook</option>
                        <option value="instagram" @selected(old('plateforme', $visuel->plateforme ?? '') == 'instagram')>Instagram</option>
                        <option value="linkedin" @selected(old('plateforme', $visuel->plateforme ?? '') == 'linkedin')>LinkedIn</option>
                        <option value="tiktok" @selected(old('plateforme', $visuel->plateforme ?? '') == 'tiktok')>TikTok</option>
                        <option value="youtube" @selected(old('plateforme', $visuel->plateforme ?? '') == 'youtube')>YouTube</option>
                    </select>
                    @error('plateforme')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id" class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $visuel->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="creation" @selected(old('statut', $visuel->statut ?? 'creation') == 'creation')>Création</option>
                        <option value="programme" @selected(old('statut', $visuel->statut ?? '') == 'programme')>Programmé</option>
                        <option value="publie" @selected(old('statut', $visuel->statut ?? '') == 'publie')>Publié</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de publication</label>
                    <input type="datetime-local"
                           name="date_publication"
                           class="form-control form-control-lg rounded-4 @error('date_publication') is-invalid @enderror"
                           value="{{ old('date_publication', isset($visuel->date_publication) ? \Carbon\Carbon::parse($visuel->date_publication)->format('Y-m-d\TH:i') : '') }}">
                    @error('date_publication')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fichier</label>
                    <input type="text"
                           name="fichier"
                           class="form-control form-control-lg rounded-4 @error('fichier') is-invalid @enderror"
                           value="{{ old('fichier', $visuel->fichier ?? '') }}"
                           placeholder="Ex : social/post-instagram-v3.png">
                    @error('fichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>