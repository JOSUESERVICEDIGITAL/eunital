@extends('back.formation.layouts.app')

@section('title', 'Créer un devoir')
@section('page_title', 'Nouveau devoir')
@section('page_subtitle', 'Ajouter un devoir, exercice ou évaluation')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du devoir
                </h3>
            </div>
            <form action="{{ route('back.formation.devoirs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.formation.devoirs.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Conseils par type
                </h3>
            </div>
            <div class="card-body" id="typeTips">
                <div class="alert alert-info" data-type="exercice">
                    <i class="fas fa-code"></i>
                    <strong>Exercice :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Décrivez clairement l'objectif</li>
                        <li>Fournissez des fichiers de base si nécessaire</li>
                        <li>Ajoutez une solution type</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="quiz" style="display: none;">
                    <i class="fas fa-puzzle-piece"></i>
                    <strong>Quiz :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Créez des questions à choix multiples</li>
                        <li>Définissez un score de réussite</li>
                        <li>Ajoutez des explications pour les réponses</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="projet" style="display: none;">
                    <i class="fas fa-project-diagram"></i>
                    <strong>Projet :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Définissez les livrables attendus</li>
                        <li>Précisez les délais intermédiaires</li>
                        <li>Détaillez les critères d'évaluation</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="examen" style="display: none;">
                    <i class="fas fa-graduation-cap"></i>
                    <strong>Examen :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Définissez la durée de l'examen</li>
                        <li>Précisez les modalités (surveillé, en ligne)</li>
                        <li>Indiquez les documents autorisés</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Bonnes pratiques
                </h3>
            </div>
            <div class="card-body">
                <ul class="text-muted">
                    <li>Fixez une date limite raisonnable</li>
                    <li>Précisez le barème de notation</li>
                    <li>Testez le devoir avant publication</li>
                    <li>Ajoutez des ressources si nécessaire</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Afficher les conseils selon le type sélectionné
        $('#type').on('change', function() {
            var type = $(this).val();
            $('#typeTips .alert').hide();
            $('#typeTips .alert[data-type="' + type + '"]').show();
        });
        
        // Déclencher au chargement
        $('#type').trigger('change');
        
        // Vérification de la date limite
        $('#date_limite').on('change', function() {
            var date = $(this).val();
            if (date && new Date(date) < new Date()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Date passée',
                    text: 'La date limite est déjà passée. Les étudiants ne pourront pas soumettre.',
                    confirmButtonColor: '#ffc107'
                });
            }
        });
    });
</script>
@endpush