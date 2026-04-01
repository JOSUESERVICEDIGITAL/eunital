<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche commande studio</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Titre de la commande</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $commandeStudio->titre ?? '') }}"
                           placeholder="Ex : Captation mariage, Clip promo, Album audio...">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id" class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $commandeStudio->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        <option value="audio" @selected(old('type', $commandeStudio->type ?? '') == 'audio')>Audio</option>
                        <option value="video" @selected(old('type', $commandeStudio->type ?? '') == 'video')>Vidéo</option>
                        <option value="mariage" @selected(old('type', $commandeStudio->type ?? '') == 'mariage')>Mariage</option>
                        <option value="multimedia" @selected(old('type', $commandeStudio->type ?? '') == 'multimedia')>Multimédia</option>
                        <option value="evenement" @selected(old('type', $commandeStudio->type ?? '') == 'evenement')>Événement</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="en_attente" @selected(old('statut', $commandeStudio->statut ?? 'en_attente') == 'en_attente')>En attente</option>
                        <option value="en_cours" @selected(old('statut', $commandeStudio->statut ?? '') == 'en_cours')>En cours</option>
                        <option value="livre" @selected(old('statut', $commandeStudio->statut ?? '') == 'livre')>Livrée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description"
                              rows="5"
                              class="form-control rounded-4 @error('description') is-invalid @enderror"
                              placeholder="Décris ici la demande client, les livrables, les besoins et les détails utiles...">{{ old('description', $commandeStudio->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

</div>