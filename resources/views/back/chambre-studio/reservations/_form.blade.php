<div class="row g-4">

    <div class="col-12">
        <div class="content-card h-100">
            <div class="mb-3">
                <div class="mini-label">Informations principales</div>
                <h5 class="mb-0">Fiche de réservation studio</h5>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Client</label>
                    <select name="client_studio_id" class="form-select form-select-lg rounded-4 @error('client_studio_id') is-invalid @enderror">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                @selected(old('client_studio_id', $reservationStudio->client_studio_id ?? '') == $client->id)>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_studio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Salle</label>
                    <input type="text"
                           name="salle"
                           class="form-control form-control-lg rounded-4 @error('salle') is-invalid @enderror"
                           value="{{ old('salle', $reservationStudio->salle ?? '') }}"
                           placeholder="Ex : Studio A, Cabine voix, Salle mixage...">
                    @error('salle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de début</label>
                    <input type="datetime-local"
                           name="date_debut"
                           class="form-control form-control-lg rounded-4 @error('date_debut') is-invalid @enderror"
                           value="{{ old('date_debut', isset($reservationStudio->date_debut) ? \Carbon\Carbon::parse($reservationStudio->date_debut)->format('Y-m-d\TH:i') : '') }}">
                    @error('date_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de fin</label>
                    <input type="datetime-local"
                           name="date_fin"
                           class="form-control form-control-lg rounded-4 @error('date_fin') is-invalid @enderror"
                           value="{{ old('date_fin', isset($reservationStudio->date_fin) ? \Carbon\Carbon::parse($reservationStudio->date_fin)->format('Y-m-d\TH:i') : '') }}">
                    @error('date_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Statut</label>
                    <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
                        <option value="reserve" @selected(old('statut', $reservationStudio->statut ?? 'reserve') == 'reserve')>Réservée</option>
                        <option value="confirme" @selected(old('statut', $reservationStudio->statut ?? '') == 'confirme')>Confirmée</option>
                        <option value="annule" @selected(old('statut', $reservationStudio->statut ?? '') == 'annule')>Annulée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="text-muted small">
                        Utilise ce statut pour suivre l’évolution de la réservation dans le pipeline studio.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>