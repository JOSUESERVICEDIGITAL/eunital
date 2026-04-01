<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-semibold">Titre du contrat</label>
        <input type="text"
               name="titre"
               class="form-control form-control-lg rounded-4"
               value="{{ old('titre', $contrat->titre ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Référence</label>
        <input type="text"
               name="reference"
               class="form-control form-control-lg rounded-4"
               value="{{ old('reference', $contrat->reference ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Type de contrat</label>
        <select name="type_contrat" class="form-select form-select-lg rounded-4">
            <option value="travail" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'travail')>Travail</option>
            <option value="prestation" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'prestation')>Prestation</option>
            <option value="partenariat" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'partenariat')>Partenariat</option>
            <option value="client" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'client')>Client</option>
            <option value="formation" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'formation')>Formation</option>
            <option value="confidentialite" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'confidentialite')>Confidentialité</option>
            <option value="consultance" @selected(old('type_contrat', $contrat->type_contrat ?? '') == 'consultance')>Consultance</option>
            <option value="autre" @selected(old('type_contrat', $contrat->type_contrat ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Partie liée</label>
        <select name="partie_type" class="form-select form-select-lg rounded-4">
            <option value="employe" @selected(old('partie_type', $contrat->partie_type ?? '') == 'employe')>Employé</option>
            <option value="client" @selected(old('partie_type', $contrat->partie_type ?? '') == 'client')>Client</option>
            <option value="prestataire" @selected(old('partie_type', $contrat->partie_type ?? '') == 'prestataire')>Prestataire</option>
            <option value="partenaire" @selected(old('partie_type', $contrat->partie_type ?? '') == 'partenaire')>Partenaire</option>
            <option value="consultant" @selected(old('partie_type', $contrat->partie_type ?? '') == 'consultant')>Consultant</option>
            <option value="autre" @selected(old('partie_type', $contrat->partie_type ?? 'autre') == 'autre')>Autre</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Statut</label>
        <select name="statut" class="form-select form-select-lg rounded-4">
            <option value="brouillon" @selected(old('statut', $contrat->statut ?? 'brouillon') == 'brouillon')>Brouillon</option>
            <option value="en_attente" @selected(old('statut', $contrat->statut ?? '') == 'en_attente')>En attente</option>
            <option value="valide" @selected(old('statut', $contrat->statut ?? '') == 'valide')>Validé</option>
            <option value="signe" @selected(old('statut', $contrat->statut ?? '') == 'signe')>Signé</option>
            <option value="rejete" @selected(old('statut', $contrat->statut ?? '') == 'rejete')>Rejeté</option>
            <option value="archive" @selected(old('statut', $contrat->statut ?? '') == 'archive')>Archivé</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date début</label>
        <input type="date"
               name="date_debut"
               class="form-control form-control-lg rounded-4"
               value="{{ old('date_debut', isset($contrat->date_debut) ? \Carbon\Carbon::parse($contrat->date_debut)->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Date fin</label>
        <input type="date"
               name="date_fin"
               class="form-control form-control-lg rounded-4"
               value="{{ old('date_fin', isset($contrat->date_fin) ? \Carbon\Carbon::parse($contrat->date_fin)->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Montant</label>
        <input type="number"
               step="0.01"
               name="montant"
               class="form-control form-control-lg rounded-4"
               value="{{ old('montant', $contrat->montant ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">PDF du contrat</label>
        <input type="file"
               name="fichier_pdf"
               class="form-control form-control-lg rounded-4">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Contenu</label>
        <textarea name="contenu" rows="6" class="form-control rounded-4">{{ old('contenu', $contrat->contenu ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Notes internes</label>
        <textarea name="notes" rows="4" class="form-control rounded-4">{{ old('notes', $contrat->notes ?? '') }}</textarea>
    </div>

</div>
