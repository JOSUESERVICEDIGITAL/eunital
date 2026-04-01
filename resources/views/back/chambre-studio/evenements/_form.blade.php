<div class="row g-3">

    <div class="col-md-6">
        <label class="form-label">Titre</label>
        <input type="text"
               name="titre"
               class="form-control"
               value="{{ old('titre', $evenementStudio->titre ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Client</label>
        <select name="client_studio_id" class="form-select">
            <option value="">-- Sélectionner --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                    @selected(old('client_studio_id', $evenementStudio->client_studio_id ?? '') == $client->id)>
                    {{ $client->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Type</label>
        <input type="text"
               name="type"
               class="form-control"
               value="{{ old('type', $evenementStudio->type ?? '') }}"
               placeholder="mariage, concert, conférence...">
    </div>

    <div class="col-md-4">
        <label class="form-label">Date</label>
        <input type="date"
               name="date"
               class="form-control"
               value="{{ old('date', isset($evenementStudio) && $evenementStudio->date ? $evenementStudio->date->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Statut</label>
        <select name="statut" class="form-select">
            <option value="planifie" @selected(old('statut', $evenementStudio->statut ?? 'planifie') == 'planifie')>Planifié</option>
            <option value="realise" @selected(old('statut', $evenementStudio->statut ?? '') == 'realise')>Réalisé</option>
            <option value="annule" @selected(old('statut', $evenementStudio->statut ?? '') == 'annule')>Annulé</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Lieu</label>
        <input type="text"
               name="lieu"
               class="form-control"
               value="{{ old('lieu', $evenementStudio->lieu ?? '') }}">
    </div>

</div>