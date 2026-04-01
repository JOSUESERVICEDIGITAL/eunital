<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche de captation</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Titre de la captation</label>
                    <input type="text"
                           name="titre"
                           class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
                           value="{{ old('titre', $captationStudio->titre ?? '') }}"
                           placeholder="Ex : Captation mariage Ruth & Daniel">
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Événement lié</label>
                    <select name="evenement_studio_id" class="form-select form-select-lg rounded-4 @error('evenement_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($evenements as $evenement)
                            <option value="{{ $evenement->id }}"
                                @selected(old('evenement_studio_id', $captationStudio->evenement_studio_id ?? '') == $evenement->id)>
                                {{ $evenement->titre }}
                            </option>
                        @endforeach
                    </select>
                    @error('evenement_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date</label>
                    <input type="date"
                           name="date"
                           class="form-control form-control-lg rounded-4 @error('date') is-invalid @enderror"
                           value="{{ old('date', isset($captationStudio->date) ? \Carbon\Carbon::parse($captationStudio->date)->format('Y-m-d') : '') }}">
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Lieu</label>
                    <input type="text"
                           name="lieu"
                           class="form-control form-control-lg rounded-4 @error('lieu') is-invalid @enderror"
                           value="{{ old('lieu', $captationStudio->lieu ?? '') }}"
                           placeholder="Ex : Salle des fêtes, Cathédrale, Hôtel...">
                    @error('lieu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select form-select-lg rounded-4 @error('type') is-invalid @enderror">
                        <option value="conference" @selected(old('type', $captationStudio->type ?? 'conference') == 'conference')>Conférence</option>
                        <option value="concert" @selected(old('type', $captationStudio->type ?? '') == 'concert')>Concert</option>
                        <option value="mariage" @selected(old('type', $captationStudio->type ?? '') == 'mariage')>Mariage</option>
                        <option value="evenement" @selected(old('type', $captationStudio->type ?? '') == 'evenement')>Événement</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="mb-3">
                <div class="mini-label">Workflow</div>
                <h5 class="mb-0">Suivi de traitement</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="planifie" @selected(old('statut', $captationStudio->statut ?? 'planifie') == 'planifie')>Planifiée</option>
                        <option value="en_cours" @selected(old('statut', $captationStudio->statut ?? '') == 'en_cours')>En cours</option>
                        <option value="termine" @selected(old('statut', $captationStudio->statut ?? '') == 'termine')>Terminée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="text-muted small">
                        Utilise ce statut pour suivre l’évolution terrain de la captation.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>