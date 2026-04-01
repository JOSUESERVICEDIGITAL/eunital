@extends('back.formation.layouts.app')

@section('title', 'Créer un contenu')
@section('page_title', 'Nouveau contenu pédagogique')
@section('page_subtitle', 'Ajouter un contenu (vidéo, document, image, audio, quiz, exercice, tutoriel)')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Informations du contenu
                </h3>
            </div>
            <form action="{{ route('back.formation.contenus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('back.formation.contenus.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('back.formation.contenus.index') }}" class="btn btn-secondary">
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
                <div class="alert alert-info" data-type="video">
                    <i class="fas fa-video"></i>
                    <strong>Vidéo :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Formats supportés : MP4, WebM, OGG</li>
                        <li>Taille max : 100 Mo</li>
                        <li>Utilisez une résolution adaptée (720p ou 1080p)</li>
                        <li>Ajoutez des sous-titres si possible</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="document" style="display: none;">
                    <i class="fas fa-file-alt"></i>
                    <strong>Document :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Formats supportés : PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX</li>
                        <li>Taille max : 50 Mo</li>
                        <li>Rendez-le téléchargeable pour permettre aux apprenants de le conserver</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="image" style="display: none;">
                    <i class="fas fa-image"></i>
                    <strong>Image :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Formats supportés : JPG, PNG, GIF, SVG</li>
                        <li>Taille max : 10 Mo</li>
                        <li>Optimisez les images pour le web</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="audio" style="display: none;">
                    <i class="fas fa-headphones"></i>
                    <strong>Audio :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Formats supportés : MP3, WAV, OGG</li>
                        <li>Taille max : 50 Mo</li>
                        <li>Assurez une bonne qualité sonore</li>
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
                <div class="alert alert-info" data-type="exercice" style="display: none;">
                    <i class="fas fa-code"></i>
                    <strong>Exercice :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Décrivez clairement l'objectif</li>
                        <li>Fournissez des fichiers de base si nécessaire</li>
                        <li>Ajoutez une solution type</li>
                    </ul>
                </div>
                <div class="alert alert-info" data-type="tutoriel" style="display: none;">
                    <i class="fas fa-chalkboard"></i>
                    <strong>Tutoriel :</strong>
                    <ul class="mt-2 mb-0">
                        <li>Structurez en étapes logiques</li>
                        <li>Ajoutez des captures d'écran</li>
                        <li>Rendez-le interactif si possible</li>
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
                    <li>Utilisez des titres clairs et descriptifs</li>
                    <li>Ajoutez une description détaillée</li>
                    <li>Vérifiez la compatibilité des fichiers</li>
                    <li>Testez les contenus avant publication</li>
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
            
            // Ajuster le formulaire selon le type
            if (type === 'video' || type === 'document' || type === 'image' || type === 'audio') {
                $('.file-upload-section').show();
                $('.text-content-section').hide();
                $('#fichier').prop('required', true);
                $('#contenu').prop('required', false);
            } else if (type === 'quiz' || type === 'exercice' || type === 'tutoriel') {
                $('.file-upload-section').hide();
                $('.text-content-section').show();
                $('#fichier').prop('required', false);
                $('#contenu').prop('required', true);
            }
        });
        
        // Déclencher le changement initial
        $('#type').trigger('change');
    });
</script>
@endpush