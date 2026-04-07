<div class="form-group">
    <label for="nom">Nom <span class="text-danger">*</span></label>
    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $entreprise->nom ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="siret">SIRET (14 chiffres)</label>
            <input type="text" name="siret" id="siret" class="form-control" value="{{ old('siret', $entreprise->siret ?? '') }}" maxlength="14" pattern="[0-9]{14}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="siren">SIREN (9 chiffres)</label>
            <input type="text" name="siren" id="siren" class="form-control" value="{{ old('siren', $entreprise->siren ?? '') }}" maxlength="9" pattern="[0-9]{9}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="ape">Code APE</label>
            <input type="text" name="ape" id="ape" class="form-control" value="{{ old('ape', $entreprise->ape ?? '') }}" maxlength="5">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="forme_juridique">Forme juridique</label>
            <select name="forme_juridique" id="forme_juridique" class="form-control">
                <option value="">Sélectionner</option>
                <option value="sa" {{ old('forme_juridique', $entreprise->forme_juridique ?? '') == 'sa' ? 'selected' : '' }}>SA</option>
                <option value="sas" {{ old('forme_juridique', $entreprise->forme_juridique ?? '') == 'sas' ? 'selected' : '' }}>SAS</option>
                <option value="sarl" {{ old('forme_juridique', $entreprise->forme_juridique ?? '') == 'sarl' ? 'selected' : '' }}>SARL</option>
                <option value="ei" {{ old('forme_juridique', $entreprise->forme_juridique ?? '') == 'ei' ? 'selected' : '' }}>Entreprise individuelle</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="capital_social">Capital social</label>
            <input type="text" name="capital_social" id="capital_social" class="form-control" value="{{ old('capital_social', $entreprise->capital_social ?? '') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse', $entreprise->adresse ?? '') }}">
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="code_postal">Code postal</label>
            <input type="text" name="code_postal" id="code_postal" class="form-control" value="{{ old('code_postal', $entreprise->code_postal ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control" value="{{ old('ville', $entreprise->ville ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="pays">Pays</label>
            <input type="text" name="pays" id="pays" class="form-control" value="{{ old('pays', $entreprise->pays ?? 'France') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $entreprise->telephone ?? '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $entreprise->email ?? '') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="site_web">Site web</label>
    <input type="url" name="site_web" id="site_web" class="form-control" value="{{ old('site_web', $entreprise->site_web ?? '') }}">
</div>

<div class="form-group">
    <label for="date_creation">Date de création</label>
    <input type="date" name="date_creation" id="date_creation" class="form-control" value="{{ old('date_creation', isset($entreprise) && $entreprise->date_creation ? $entreprise->date_creation->format('Y-m-d') : '') }}">
</div>