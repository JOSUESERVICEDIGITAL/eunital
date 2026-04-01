<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre du positionnement</label>
        <input type="text" name="titre"
               class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
               value="{{ old('titre', $positionnementMarketing->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="brouillon" @selected(old('statut', $positionnementMarketing->statut ?? 'brouillon') === 'brouillon')>Brouillon</option>
            <option value="actif" @selected(old('statut', $positionnementMarketing->statut ?? '') === 'actif')>Actif</option>
            <option value="a_revoir" @selected(old('statut', $positionnementMarketing->statut ?? '') === 'a_revoir')>À revoir</option>
            <option value="archive" @selected(old('statut', $positionnementMarketing->statut ?? '') === 'archive')>Archivé</option>
        </select>
        @error('statut')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Auteur</label>
        <select name="auteur_id" class="form-select form-select-lg rounded-4">
            <option value="">Utilisateur connecté</option>
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}"
                    @selected(old('auteur_id', $positionnementMarketing->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Segment cible</label>
        <input type="text" name="segment_cible"
               class="form-control form-control-lg rounded-4"
               value="{{ old('segment_cible', $positionnementMarketing->segment_cible ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Problème adressé</label>
        <textarea name="probleme_adresse" rows="4" class="form-control rounded-4">{{ old('probleme_adresse', $positionnementMarketing->probleme_adresse ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Promesse</label>
        <textarea name="promesse" rows="4" class="form-control rounded-4">{{ old('promesse', $positionnementMarketing->promesse ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Différenciation</label>
        <textarea name="differenciation" rows="4" class="form-control rounded-4">{{ old('differenciation', $positionnementMarketing->differenciation ?? '') }}</textarea>
    </div>

    <div class="col-md-8">
        <label class="form-label fw-semibold">Message central</label>
        <textarea name="message_central" rows="4" class="form-control rounded-4">{{ old('message_central', $positionnementMarketing->message_central ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Canal principal</label>
        <input type="text" name="canal_principal"
               class="form-control form-control-lg rounded-4"
               value="{{ old('canal_principal', $positionnementMarketing->canal_principal ?? '') }}">
    </div>
</div>