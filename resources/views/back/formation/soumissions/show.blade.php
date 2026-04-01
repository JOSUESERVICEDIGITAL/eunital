@extends('back.formation.layouts.app')

@section('title', 'Détails de la soumission')
@section('page_title', 'Soumission de ' . $soumission->user->name)
@section('page_subtitle', $soumission->devoir->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations générales
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Étudiant</dt>
                    <dd class="col-sm-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle mr-2" style="width: 40px; height: 40px; font-size: 16px;">
                                {{ substr($soumission->user->name, 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $soumission->user->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $soumission->user->email }}</small>
                            </div>
                        </div>
                    </dd>
                    
                    <dt class="col-sm-4">Devoir</dt>
                    <dd class="col-sm-8">
                        <strong>{{ $soumission->devoir->titre }}</strong>
                        <br>
                        <small class="text-muted">{{ $soumission->devoir->type }}</small>
                    </dd>
                    
                    <dt class="col-sm-4">Cours</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('back.formation.cours.show', $soumission->devoir->cour) }}" class="text-info">
                            {{ $soumission->devoir->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-4">Soumis le</dt>
                    <dd class="col-sm-8">
                        {{ $soumission->soumis_le->format('d/m/Y H:i:s') }}
                        <br>
                        <small class="text-muted">il y a {{ $soumission->soumis_le->diffForHumans() }}</small>
                    </dd>
                    
                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @if($soumission->est_en_retard)
                            <span class="badge badge-danger">En retard</span>
                        @else
                            <span class="badge badge-success">À l'heure</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Note maximale</dt>
                    <dd class="col-sm-8">{{ $soumission->devoir->note_maximale }}/{{ $soumission->devoir->note_maximale }}</dd>
                </dl>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-paperclip mr-2"></i>
                    Fichiers joints
                </h3>
            </div>
            <div class="card-body">
                @if($soumission->fichiers && count($soumission->fichiers) > 0)
                    <div class="list-group">
                        @foreach($soumission->fichiers as $index => $fichier)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-alt mr-2 text-primary"></i>
                                    <strong>{{ $fichier['name'] }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        @if(isset($fichier['size']))
                                            {{ number_format($fichier['size'] / 1024, 2) }} KB
                                        @endif
                                    </small>
                                </div>
                                <a href="{{ route('back.formation.soumissions.telecharger-fichier', [$soumission, $index]) }}" class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-paperclip fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun fichier joint</p>
                    </div>
                @endif
            </div>
        </div>
        
        @if($soumission->contenu)
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comment mr-2"></i>
                    Commentaire de l'étudiant
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted">{{ $soumission->contenu }}</p>
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-md-7">
        <div class="card" id="correction">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-check-double mr-2"></i>
                    Correction
                </h3>
                @if($soumission->est_corrige)
                    <div class="card-tools">
                        <span class="badge badge-success">Déjà corrigé</span>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @if($soumission->est_corrige)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <strong>Ce devoir a été corrigé le {{ $soumission->note_le->format('d/m/Y H:i') }}</strong>
                    </div>
                    
                    <dl class="row">
                        <dt class="col-sm-3">Note obtenue</dt>
                        <dd class="col-sm-9">
                            <span class="badge badge-{{ $soumission->note >= ($soumission->devoir->note_maximale * 0.6) ? 'success' : 'warning' }} badge-lg">
                                {{ $soumission->note }}/{{ $soumission->devoir->note_maximale }}
                            </span>
                            <br>
                            <small>Soit {{ round($soumission->note_sur_20, 1) }}/20</small>
                        </dd>
                        
                        @if($soumission->commentaire_enseignant)
                        <dt class="col-sm-3">Commentaire</dt>
                        <dd class="col-sm-9">
                            <div class="well well-sm bg-light p-3 rounded">
                                {{ $soumission->commentaire_enseignant }}
                            </div>
                        </dd>
                        @endif
                    </dl>
                    
                    <div class="mt-3">
                        <button type="button" class="btn btn-warning" onclick="modifierCorrection()">
                            <i class="fas fa-edit"></i> Modifier la correction
                        </button>
                    </div>
                    
                    <div id="correctionForm" style="display: none;" class="mt-3">
                        <form action="{{ route('back.formation.soumissions.noter', $soumission) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="note">Note <span class="text-danger">*</span></label>
                                <input type="number" name="note" id="note" class="form-control" 
                                       value="{{ $soumission->note }}" 
                                       min="0" max="{{ $soumission->devoir->note_maximale }}" 
                                       step="0.5" required>
                                <small class="text-muted">Note sur {{ $soumission->devoir->note_maximale }}</small>
                            </div>
                            <div class="form-group">
                                <label for="commentaire_enseignant">Commentaire</label>
                                <textarea name="commentaire_enseignant" id="commentaire_enseignant" rows="4" 
                                          class="form-control">{{ $soumission->commentaire_enseignant }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer la correction
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="annulerCorrection()">
                                Annuler
                            </button>
                        </form>
                    </div>
                    
                @else
                    <form action="{{ route('back.formation.soumissions.noter', $soumission) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="note">Note <span class="text-danger">*</span></label>
                            <input type="number" name="note" id="note" class="form-control" 
                                   value="{{ old('note') }}" 
                                   min="0" max="{{ $soumission->devoir->note_maximale }}" 
                                   step="0.5" required>
                            <small class="text-muted">Note sur {{ $soumission->devoir->note_maximale }}</small>
                        </div>
                        <div class="form-group">
                            <label for="commentaire_enseignant">Commentaire</label>
                            <textarea name="commentaire_enseignant" id="commentaire_enseignant" rows="6" 
                                      class="form-control">{{ old('commentaire_enseignant') }}</textarea>
                            <small class="text-muted">Feedbacks, points à améliorer, félicitations...</small>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-double"></i> Corriger et noter
                        </button>
                        <a href="{{ route('back.formation.soumissions.a-corriger') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour à la liste
                        </a>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function modifierCorrection() {
        $('#correctionForm').show();
        $('.alert-success').hide();
    }
    
    function annulerCorrection() {
        $('#correctionForm').hide();
        $('.alert-success').show();
    }
</script>
@endpush