@extends('back.layouts.principal')

@section('title', 'Alertes innovation')
@section('page_title', 'Alertes & points critiques')
@section('page_subtitle', 'Surveillance des innovations critiques et déploiements suspendus.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="content-card">
            <div class="section-head">
                <div>
                    <h4>Centre d’alertes</h4>
                    <p>Priorités critiques, suspensions, blocages et risques de gouvernance.</p>
                </div>
                <a href="{{ route('back.innovations.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Retour dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Innovations critiques</h5>

            <div class="hub-list">
                @forelse($innovationsCritiques as $innovation)
                    <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="hub-list-item alert-item">
                        <div class="hub-list-icon danger">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $innovation->titre }}</div>
                            <small>{{ $innovation->statut }} • {{ $innovation->niveau_priorite }}</small>
                        </div>
                    </a>
                @empty
                    <div class="empty-mini">Aucune innovation critique.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Déploiements suspendus</h5>

            <div class="hub-list">
                @forelse($deploiementsSuspendus as $deploiement)
                    <a href="{{ route('back.innovations.deploiements.show', $deploiement) }}" class="hub-list-item alert-item">
                        <div class="hub-list-icon secondary">
                            <i class="fa-solid fa-pause"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $deploiement->titre }}</div>
                            <small>{{ optional($deploiement->innovation)->titre ?? 'Innovation non liée' }}</small>
                        </div>
                    </a>
                @empty
                    <div class="empty-mini">Aucun déploiement suspendu.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@include('back.innovations.dashboard._styles')
@endsection
