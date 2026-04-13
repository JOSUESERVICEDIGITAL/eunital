@extends('back.formation.layouts.app')

@section('title', 'Nouvelle inscription')
@section('page_title', 'Créer une inscription')
@section('page_subtitle', 'Inscrire un étudiant à un module de formation')

@section('formation-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-plus mr-2"></i>
                    Informations de l'inscription
                </h3>

                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#helperModal">
                    <i class="fas fa-lightbulb mr-1"></i> Aide rapide
                </button>
            </div>

            <form action="{{ route('back.formation.inscriptions.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('back.formation.inscriptions.form')
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-info-circle mr-2"></i> Informations
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Statuts :</strong>
                    <ul class="mt-2 mb-0">
                        <li><span class="badge badge-warning">En attente</span> Demande en cours</li>
                        <li><span class="badge badge-success">Validé</span> Accès accordé</li>
                        <li><span class="badge badge-info">Terminé</span> Module complété</li>
                        <li><span class="badge badge-danger">Abandonné</span> Parcours arrêté</li>
                    </ul>
                </div>

                <ul class="text-muted small pl-3 mb-0">
                    <li>Une seule inscription par module et par étudiant</li>
                    <li>La progression peut être recalculée après</li>
                    <li>Les dates peuvent être ajustées</li>
                </ul>
            </div>
        </div>

        <div class="card mt-3 shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-chart-line mr-2"></i> Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-8">Total</dt>
                    <dd class="col-sm-4"><span class="badge badge-primary">{{ $totalInscriptions ?? 0 }}</span></dd>

                    <dt class="col-sm-8">En attente</dt>
                    <dd class="col-sm-4"><span class="badge badge-warning">{{ $enAttente ?? 0 }}</span></dd>

                    <dt class="col-sm-8">Validées</dt>
                    <dd class="col-sm-4"><span class="badge badge-success">{{ $validees ?? 0 }}</span></dd>

                    <dt class="col-sm-8">Terminées</dt>
                    <dd class="col-sm-4"><span class="badge badge-info">{{ $terminees ?? 0 }}</span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="helperModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-lightbulb mr-2"></i> Aide rapide
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <ul class="mb-0">
                    <li>Sélectionne d’abord l’étudiant.</li>
                    <li>Choisis ensuite le module.</li>
                    <li>Utilise “en attente” si tu veux valider plus tard.</li>
                    <li>La progression peut rester à 0 au départ.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
