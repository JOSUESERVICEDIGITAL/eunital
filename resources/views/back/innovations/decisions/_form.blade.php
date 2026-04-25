<div class="row g-4">

    <div class="col-md-6">
        <label>Réforme</label>
        <select name="reforme_interne_id" class="form-select hub-input">
            @foreach($reformes as $r)
                <option value="{{ $r->id }}" @selected(old('reforme_interne_id',$decision->reforme_interne_id ?? '')==$r->id)>
                    {{ $r->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Auteur</label>
        <select name="auteur_id" class="form-select hub-input">
            @foreach($users as $u)
                <option value="{{ $u->id }}" @selected(old('auteur_id',$decision->auteur_id ?? '')==$u->id)>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label>Titre</label>
        <input type="text" name="titre" class="form-control hub-input" value="{{ old('titre',$decision->titre ?? '') }}">
    </div>

    <div class="col-12">
        <label>Décision</label>
        <textarea name="decision" class="form-control">{{ old('decision',$decision->decision ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label>Date</label>
        <input type="date" name="date_decision" class="form-control"
               value="{{ old('date_decision', optional($decision->date_decision ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-6">
        <label>Statut</label>
        <select name="statut" class="form-select">
            @foreach(['proposee','validee','rejetee'] as $s)
                <option value="{{ $s }}" @selected(old('statut',$decision->statut ?? '')==$s)>
                    {{ ucfirst($s) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <button class="btn btn-warning">Enregistrer</button>
    </div>

</div>
