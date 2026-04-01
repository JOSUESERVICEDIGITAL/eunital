<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre de la maintenance</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $maintenanceTechnique->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="ouverte" @selected(old('statut', $maintenanceTechnique->statut ?? 'ouverte') === 'ouverte')>Ouverte</option>
            <option value="en_cours" @selected(old('statut', $maintenanceTechnique->statut ?? '') === 'en_cours')>En cours</option>
            <option value="resolue" @selected(old('statut', $maintenanceTechnique->statut ?? '') === 'resolue')>Résolue</option>
            <option value="fermee" @selected(old('statut', $maintenanceTechnique->statut ?? '') === 'fermee')>Fermée</option>
            <option value="reportee" @selected(old('statut', $maintenanceTechnique->statut ?? '') === 'reportee')>Reportée</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4 @error('auteur_id') is-invalid @enderror">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $maintenanceTechnique->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Responsable</label>
        <select name="responsable_id" class="form-select form-select-lg rounded-4 @error('responsable_id') is-invalid @enderror">
            <option value="">Aucun</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('responsable_id', $maintenanceTechnique->responsable_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('responsable_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de maintenance</label>
        <select name="type_maintenance" class="form-select form-select-lg rounded-4 @error('type_maintenance') is-invalid @enderror">
            <option value="corrective" @selected(old('type_maintenance', $maintenanceTechnique->type_maintenance ?? 'corrective') === 'corrective')>Corrective</option>
            <option value="preventive" @selected(old('type_maintenance', $maintenanceTechnique->type_maintenance ?? '') === 'preventive')>Préventive</option>
            <option value="evolutive" @selected(old('type_maintenance', $maintenanceTechnique->type_maintenance ?? '') === 'evolutive')>Évolutive</option>
            <option value="urgence" @selected(old('type_maintenance', $maintenanceTechnique->type_maintenance ?? '') === 'urgence')>Urgence</option>
            <option value="securite" @selected(old('type_maintenance', $maintenanceTechnique->type_maintenance ?? '') === 'securite')>Sécurité</option>
        </select>
        @error('type_maintenance')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Niveau d’urgence</label>
        <select name="niveau_urgence" class="form-select form-select-lg rounded-4 @error('niveau_urgence') is-invalid @enderror">
            <option value="faible" @selected(old('niveau_urgence', $maintenanceTechnique->niveau_urgence ?? 'moyenne') === 'faible')>Faible</option>
            <option value="moyenne" @selected(old('niveau_urgence', $maintenanceTechnique->niveau_urgence ?? 'moyenne') === 'moyenne')>Moyenne</option>
            <option value="haute" @selected(old('niveau_urgence', $maintenanceTechnique->niveau_urgence ?? '') === 'haute')>Haute</option>
            <option value="critique" @selected(old('niveau_urgence', $maintenanceTechnique->niveau_urgence ?? '') === 'critique')>Critique</option>
        </select>
        @error('niveau_urgence')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $maintenanceTechnique->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date de signalement</label>
        <input type="datetime-local" name="date_signalement"
            class="form-control form-control-lg rounded-4 @error('date_signalement') is-invalid @enderror"
            value="{{ old('date_signalement', isset($maintenanceTechnique?->date_signalement) ? $maintenanceTechnique->date_signalement->format('Y-m-d\TH:i') : '') }}">
        @error('date_signalement')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date de résolution</label>
        <input type="datetime-local" name="date_resolution"
            class="form-control form-control-lg rounded-4 @error('date_resolution') is-invalid @enderror"
            value="{{ old('date_resolution', isset($maintenanceTechnique?->date_resolution) ? $maintenanceTechnique->date_resolution->format('Y-m-d\TH:i') : '') }}">
        @error('date_resolution')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
