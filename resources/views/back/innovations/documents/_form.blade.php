<div class="row g-4">

    <div class="col-md-6">
        <label>Innovation</label>
        <select name="innovation_id" class="form-select hub-input">
            @foreach($innovations as $i)
                <option value="{{ $i->id }}" @selected(old('innovation_id',$document->innovation_id ?? '')==$i->id)>
                    {{ $i->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control hub-input"
               value="{{ old('nom',$document->nom ?? '') }}">
    </div>

    <div class="col-md-6">
        <label>Type</label>
        <select name="type" class="form-select">
            @foreach(['rapport','pdf','image','contrat','autre'] as $t)
                <option value="{{ $t }}" @selected(old('type',$document->type ?? '')==$t)>
                    {{ ucfirst($t) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Fichier</label>
        <input type="file" name="file" class="form-control">
    </div>

    <div class="col-12">
        <label>Description</label>
        <textarea name="description" class="form-control">
            {{ old('description',$document->description ?? '') }}
        </textarea>
    </div>

    <div class="col-12">
        <button class="btn btn-warning">Enregistrer</button>
    </div>

</div>
