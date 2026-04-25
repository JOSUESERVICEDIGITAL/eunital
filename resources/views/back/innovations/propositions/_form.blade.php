<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre',$proposition->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Origine</label>
        <select name="origine" class="form-select hub-input">
            @foreach(['interne','citoyen','institution','partenaire'] as $o)
                <option value="{{ $o }}" @selected(old('origine',$proposition->origine ?? '')==$o)>
                    {{ ucfirst($o) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Priorité</label>
        <select name="niveau_priorite" class="form-select hub-input">
            @foreach(['faible','moyenne','haute','critique'] as $p)
                <option value="{{ $p }}" @selected(old('niveau_priorite',$proposition->niveau_priorite ?? '')==$p)>
                    {{ ucfirst($p) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input">
            @foreach(['soumis','en_etude','retenu','rejete','transforme_en_projet'] as $s)
                <option value="{{ $s }}" @selected(old('statut',$proposition->statut ?? '')==$s)>
                    {{ ucfirst(str_replace('_',' ',$s)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Décideur</label>
        <select name="decideur_id" class="form-select hub-input">
            <option value="">--</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" @selected(old('decideur_id',$proposition->decideur_id ?? '')==$u->id)>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" rows="5" class="form-control">{{ old('description',$proposition->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <button class="btn btn-warning rounded-pill px-4">Enregistrer</button>
    </div>

</div>
