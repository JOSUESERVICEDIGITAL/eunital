<div class="row g-4">

    <div class="col-md-8">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="titre" class="form-control hub-input"
               value="{{ old('titre',$deploiement->titre ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Innovation</label>
        <select name="innovation_id" class="form-select hub-input">
            <option value="">--</option>
            @foreach($innovations as $i)
                <option value="{{ $i->id }}" @selected(old('innovation_id',$deploiement->innovation_id ?? '')==$i->id)>
                    {{ $i->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Statut</label>
        <select name="statut" class="form-select hub-input">
            @foreach(['planifie','en_cours','generalise','suspendu'] as $s)
                <option value="{{ $s }}" @selected(old('statut',$deploiement->statut ?? '')==$s)>
                    {{ ucfirst($s) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date début</label>
        <input type="date" name="date_debut" class="form-control hub-input"
               value="{{ old('date_debut',$deploiement->date_debut ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Date fin</label>
        <input type="date" name="date_fin" class="form-control hub-input"
               value="{{ old('date_fin',$deploiement->date_fin ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" class="form-control rounded-4" rows="5">{{ old('description',$deploiement->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <button class="btn btn-warning rounded-pill px-4">Enregistrer</button>
    </div>

</div>
