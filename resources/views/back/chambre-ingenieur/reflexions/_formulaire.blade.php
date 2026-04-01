<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre</label>
        <input type="text" name="titre" class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $reflexionStrategique->titre ?? '') }}">
        @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="ouverte" @selected(old('statut', $reflexionStrategique->statut ?? 'ouverte') === 'ouverte')>Ouverte</option>
            <option value="validee" @selected(old('statut', $reflexionStrategique->statut ?? '') === 'validee')>Validée</option>
            <option value="archivee" @selected(old('statut', $reflexionStrategique->statut ?? '') === 'archivee')>Archivée</option>
        </select>
        @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $reflexionStrategique->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Contexte</label>
        <textarea name="contexte" rows="4" class="form-control rounded-4">{{ old('contexte', $reflexionStrategique->contexte ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Analyse</label>
        <textarea name="analyse" rows="6" class="form-control rounded-4">{{ old('analyse', $reflexionStrategique->analyse ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Orientation recommandée</label>
        <textarea name="orientation_recommandee" rows="5" class="form-control rounded-4">{{ old('orientation_recommandee', $reflexionStrategique->orientation_recommandee ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Impact attendu</label>
        <textarea name="impact_attendu" rows="5" class="form-control rounded-4">{{ old('impact_attendu', $reflexionStrategique->impact_attendu ?? '') }}</textarea>
    </div>
</div>