@extends('back.formation.layouts.app')

@section('title', 'Modifier le commentaire')
@section('page_title', 'Modification du commentaire')
@section('page_subtitle', 'Modifier le contenu du commentaire')

@section('formation-content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier le commentaire
                </h3>
            </div>
            <form action="{{ route('back.formation.commentaires.update', $commentaireCours) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="contenu">Contenu du commentaire <span class="text-danger">*</span></label>
                        <textarea name="contenu" id="contenu" rows="6" 
                                  class="form-control @error('contenu') is-invalid @enderror" required>{{ old('contenu', $commentaireCours->contenu) }}</textarea>
                        @error('contenu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="is_approved">Statut</label>
                        <select name="is_approved" id="is_approved" class="form-control @error('is_approved') is-invalid @enderror">
                            <option value="1" {{ old('is_approved', $commentaireCours->is_approved) ? 'selected' : '' }}>Approuvé</option>
                            <option value="0" {{ old('is_approved', $commentaireCours->is_approved) ? '' : 'selected' }}>En attente</option>
                        </select>
                        @error('is_approved')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informations :</strong>
                        <ul class="mb-0 mt-2">
                            <li>Auteur: <strong>{{ $commentaireCours->user->name }}</strong></li>
                            <li>Cours: <strong>{{ $commentaireCours->cour->titre }}</strong></li>
                            <li>Date: <strong>{{ $commentaireCours->created_at->format('d/m/Y H:i') }}</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.commentaires.show', $commentaireCours) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.formation.commentaires.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection