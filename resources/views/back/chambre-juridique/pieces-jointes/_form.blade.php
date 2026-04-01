<div class="row g-4">

    <div class="col-md-6">
        <label class="form-label fw-semibold">Titre de la pièce</label>
        <input type="text"
               name="titre"
               class="form-control form-control-lg rounded-4"
               value="{{ old('titre', $piece->titre ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Type de pièce</label>
        <select name="type_piece" class="form-select form-select-lg rounded-4">
            <option value="scan" @selected(old('type_piece', $piece->type_piece ?? '') == 'scan')>Scan</option>
            <option value="justificatif" @selected(old('type_piece', $piece->type_piece ?? '') == 'justificatif')>Justificatif</option>
            <option value="annexe" @selected(old('type_piece', $piece->type_piece ?? '') == 'annexe')>Annexe</option>
            <option value="preuve" @selected(old('type_piece', $piece->type_piece ?? '') == 'preuve')>Preuve</option>
            <option value="piece_identite" @selected(old('type_piece', $piece->type_piece ?? '') == 'piece_identite')>Pièce d'identité</option>
            <option value="signature" @selected(old('type_piece', $piece->type_piece ?? '') == 'signature')>Signature</option>
            <option value="autre" @selected(old('type_piece', $piece->type_piece ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Contrat lié</label>
        <select name="contrat_juridique_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Aucun --</option>
            @foreach(($contrats ?? []) as $contrat)
                <option value="{{ $contrat->id }}"
                    @selected(old('contrat_juridique_id', $piece->contrat_juridique_id ?? '') == $contrat->id)>
                    {{ $contrat->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Engagement lié</label>
        <select name="engagement_juridique_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Aucun --</option>
            @foreach(($engagements ?? []) as $engagement)
                <option value="{{ $engagement->id }}"
                    @selected(old('engagement_juridique_id', $piece->engagement_juridique_id ?? '') == $engagement->id)>
                    {{ $engagement->nom_complet }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Dossier lié</label>
        <select name="dossier_juridique_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Aucun --</option>
            @foreach(($dossiers ?? []) as $dossier)
                <option value="{{ $dossier->id }}"
                    @selected(old('dossier_juridique_id', $piece->dossier_juridique_id ?? '') == $dossier->id)>
                    {{ $dossier->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Archive liée</label>
        <select name="archive_hub_id" class="form-select form-select-lg rounded-4">
            <option value="">-- Aucune --</option>
            @foreach(($archives ?? []) as $archive)
                <option value="{{ $archive->id }}"
                    @selected(old('archive_hub_id', $piece->archive_hub_id ?? '') == $archive->id)>
                    {{ $archive->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Fichier</label>
        <input type="file"
               name="fichier"
               class="form-control form-control-lg rounded-4">
    </div>

</div>