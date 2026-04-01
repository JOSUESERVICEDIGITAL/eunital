@extends('back.formation.layouts.app')

@section('title', 'Vidéos')
@section('page_title', 'Bibliothèque vidéo')
@section('page_subtitle', 'Liste des contenus vidéo')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-video text-danger mr-2"></i>
            Vidéos
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.contenus.create', ['type' => 'video']) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter une vidéo
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row p-3">
            @forelse($contenus as $contenu)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($contenu->fichier)
                        @php
                            $ext = pathinfo($contenu->fichier, PATHINFO_EXTENSION);
                        @endphp
                        @if(in_array($ext, ['mp4', 'webm', 'ogg']))
                            <video class="card-img-top" style="height: 180px; object-fit: cover;" controls>
                                <source src="{{ asset('storage/' . $contenu->fichier) }}" type="video/{{ $ext }}">
                            </video>
                        @else
                            <div class="card-img-top bg-dark text-center py-5" style="height: 180px;">
                                <i class="fas fa-video fa-4x text-white"></i>
                            </div>
                        @endif
                    @else
                        <div class="card-img-top bg-secondary text-center py-5" style="height: 180px;">
                            <i class="fas fa-video fa-4x text-white"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $contenu->titre }}</h5>
                        <p class="card-text small text-muted">{{ Str::limit($contenu->contenu, 100) }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-book"></i> {{ $contenu->chapitre->cour->titre ?? 'N/A' }}
                                <br>
                                <i class="fas fa-layer-group"></i> {{ $contenu->chapitre->titre }}
                            </small>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group w-100">
                            <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            <a href="{{ route('back.formation.contenus.edit', $contenu) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            @if($contenu->fichier && $contenu->telechargeable)
                                <a href="{{ route('back.formation.contenus.download', $contenu) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-video fa-4x text-muted mb-3"></i>
                <p class="text-muted">Aucune vidéo trouvée</p>
                <a href="{{ route('back.formation.contenus.create', ['type' => 'video']) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter une vidéo
                </a>
            </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $contenus])
    </div>
</div>
@endsection