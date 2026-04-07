<div class="form-group">
    <label for="document_id">Document <span class="text-danger">*</span></label>
    <select name="document_id" id="document_id" class="form-control @error('document_id') is-invalid @enderror" required>
        <option value="">Sélectionner</option>
        @foreach($documents as $doc)
        <option value="{{ $doc->id }}" {{ old('document_id', $signature->document_id ?? '') == $doc->id ? 'selected' : '' }}>{{ $doc->titre }} ({{ $doc->numero_unique }})</option>
        @endforeach
    </select>
    @error('document_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="user_id">Signataire <span class="text-danger">*</span></label>
    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
        <option value="">Sélectionner</option>
        @foreach($utilisateurs as $user)
        <option value="{{ $user->id }}" {{ old('user_id', $signature->user_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
    </select>
    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_signataire">Type de signataire</label>
            <select name="type_signataire" id="type_signataire" class="form-control">
                <option value="signataire" {{ old('type_signataire', $signature->type_signataire ?? 'signataire') == 'signataire' ? 'selected' : '' }}>Signataire principal</option>
                <option value="temoin" {{ old('type_signataire', $signature->type_signataire ?? '') == 'temoin' ? 'selected' : '' }}>Témoin</option>
                <option value="representant" {{ old('type_signataire', $signature->type_signataire ?? '') == 'representant' ? 'selected' : '' }}>Représentant légal</option>
                <option value="garant" {{ old('type_signataire', $signature->type_signataire ?? '') == 'garant' ? 'selected' : '' }}>Garant</option>
            </select>
            @error('type_signataire')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ordre">Ordre de signature</label>
            <input type="number" name="ordre" id="ordre" class="form-control" value="{{ old('ordre', $signature->ordre ?? 0) }}" min="0">
            <small>0 = premier signataire</small>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="email">Email (si externe)</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $signature->email ?? '') }}" placeholder="email@exemple.com">
    <small>À remplir si le signataire n'est pas dans la base</small>
</div>

<div class="form-group">
    <label for="fonction">Fonction</label>
    <input type="text" name="fonction" id="fonction" class="form-control" value="{{ old('fonction', $signature->fonction ?? '') }}">
</div>

<div class="form-group">
    <label for="commentaire">Commentaire</label>
    <textarea name="commentaire" id="commentaire" rows="2" class="form-control">{{ old('commentaire', $signature->commentaire ?? '') }}</textarea>
</div>
