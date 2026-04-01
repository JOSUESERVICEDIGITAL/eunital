<div class="row g-4">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre du test</label>
        <input type="text" name="titre"
            class="form-control form-control-lg rounded-4 @error('titre') is-invalid @enderror"
            value="{{ old('titre', $testTechnique->titre ?? '') }}">
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4 @error('statut') is-invalid @enderror">
            <option value="planifie" @selected(old('statut', $testTechnique->statut ?? 'planifie') === 'planifie')>Planifié</option>
            <option value="en_cours" @selected(old('statut', $testTechnique->statut ?? '') === 'en_cours')>En cours</option>
            <option value="termine" @selected(old('statut', $testTechnique->statut ?? '') === 'termine')>Terminé</option>
            <option value="annule" @selected(old('statut', $testTechnique->statut ?? '') === 'annule')>Annulé</option>
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
                <option value="{{ $utilisateur->id }}" @selected(old('auteur_id', $testTechnique->auteur_id ?? '') == $utilisateur->id)>
                    {{ $utilisateur->name }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de test</label>
        <select name="type_test" class="form-select form-select-lg rounded-4 @error('type_test') is-invalid @enderror">
            <option value="fonctionnel" @selected(old('type_test', $testTechnique->type_test ?? 'fonctionnel') === 'fonctionnel')>Fonctionnel</option>
            <option value="unitaire" @selected(old('type_test', $testTechnique->type_test ?? '') === 'unitaire')>Unitaire</option>
            <option value="integration" @selected(old('type_test', $testTechnique->type_test ?? '') === 'integration')>Intégration</option>
            <option value="performance" @selected(old('type_test', $testTechnique->type_test ?? '') === 'performance')>Performance</option>
            <option value="securite" @selected(old('type_test', $testTechnique->type_test ?? '') === 'securite')>Sécurité</option>
            <option value="recette" @selected(old('type_test', $testTechnique->type_test ?? '') === 'recette')>Recette</option>
        </select>
        @error('type_test')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Résultat</label>
        <select name="resultat" class="form-select form-select-lg rounded-4 @error('resultat') is-invalid @enderror">
            <option value="non_execute" @selected(old('resultat', $testTechnique->resultat ?? 'non_execute') === 'non_execute')>Non exécuté</option>
            <option value="reussi" @selected(old('resultat', $testTechnique->resultat ?? '') === 'reussi')>Réussi</option>
            <option value="echoue" @selected(old('resultat', $testTechnique->resultat ?? '') === 'echoue')>Échoué</option>
            <option value="partiel" @selected(old('resultat', $testTechnique->resultat ?? '') === 'partiel')>Partiel</option>
        </select>
        @error('resultat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Environnement de test</label>
        <input type="text" name="environnement_test"
            class="form-control form-control-lg rounded-4 @error('environnement_test') is-invalid @enderror"
            value="{{ old('environnement_test', $testTechnique->environnement_test ?? '') }}">
        @error('environnement_test')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="5"
            class="form-control rounded-4 @error('description') is-invalid @enderror">{{ old('description', $testTechnique->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
