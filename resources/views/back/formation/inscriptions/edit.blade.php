@extends('back.formation.layouts.app')

@section('title', 'Modifier l\'inscription')
@section('page_title', 'Modification de l\'inscription')
@section('page_subtitle', 'Modifier les informations de l’inscription de ' . $inscription->user->name)

@section('formation-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-edit mr-2"></i> Informations de l'inscription
                </h3>

                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#statusToolsModal">
                    <i class="fas fa-bolt mr-1"></i> Actions statut
                </button>
            </div>

            <form action="{{ route('back.formation.inscriptions.update', $inscription) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    @include('back.formation.inscriptions.form')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.inscriptions.show', $inscription) }}" class="btn btn-info">
                        <i class="fas fa-eye mr-1"></i> Voir l'inscription
                    </a>
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-chart-line mr-2"></i> Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-7">Progression</dt>
                    <dd class="col-sm-5">
                        <div class="progress" style="height: 18px;">
                            <div class="progress-bar bg-primary" style="width: {{ $inscription->progression }}%">
                                {{ $inscription->progression }}%
                            </div>
                        </div>
                    </dd>

                    <dt class="col-sm-7">Cours suivis</dt>
                    <dd class="col-sm-5"><span class="badge badge-info">{{ $coursSuivis ?? 0 }}/{{ $totalCours ?? 0 }}</span></dd>

                    <dt class="col-sm-7">Présence</dt>
                    <dd class="col-sm-5"><span class="badge badge-success">{{ round($inscription->taux_presence, 1) }}%</span></dd>

                    <dt class="col-sm-7">Inscrit le</dt>
                    <dd class="col-sm-5">{{ $inscription->created_at->format('d/m/Y') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusToolsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="fas fa-bolt mr-2"></i> Actions rapides</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                @if($inscription->statut == 'en_attente')
                    <button type="button" class="btn btn-success m-1" onclick="validerInscription({{ $inscription->id }})">
                        <i class="fas fa-check-circle mr-1"></i> Valider
                    </button>
                @endif

                @if($inscription->statut == 'valide')
                    <button type="button" class="btn btn-info m-1" onclick="terminerInscription({{ $inscription->id }})">
                        <i class="fas fa-flag-checkered mr-1"></i> Terminer
                    </button>
                @endif

                @if(in_array($inscription->statut, ['en_attente', 'valide']))
                    <button type="button" class="btn btn-danger m-1" onclick="abandonnerInscription({{ $inscription->id }})">
                        <i class="fas fa-times-circle mr-1"></i> Abandonner
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
