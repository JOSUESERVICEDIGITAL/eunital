@extends('back.layouts.principal')

@section('title', 'Modifier réservation studio')
@section('page_title', 'Modifier une réservation studio')
@section('page_subtitle', 'Mets à jour la fiche, le planning, la salle et le statut de la réservation.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <form method="POST" action="{{ route('back.chambre-studio.reservations.update', $reservationStudio) }}">
                    @csrf
                    @method('PUT')

                    @include('back.chambre-studio.reservations._form')

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-pill px-4">
                            <i class="fa-solid fa-pen me-1"></i> Mettre à jour
                        </button>

                        <a href="{{ route('back.chambre-studio.reservations.details', $reservationStudio) }}" class="btn btn-light rounded-pill px-4">
                            Retour à la fiche
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Résumé</div>
                <h5 class="mb-3">Réservation actuelle</h5>

                <div class="mb-3">
                    <div class="mini-label">Client</div>
                    <div class="fw-semibold">{{ $reservationStudio->client->nom ?? '—' }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Salle</div>
                    <div class="fw-semibold">{{ $reservationStudio->salle ?: '—' }}</div>
                </div>

                <div class="mb-3">
                    <div class="mini-label">Début</div>
                    <div class="fw-semibold">
                        {{ $reservationStudio->date_debut ? \Carbon\Carbon::parse($reservationStudio->date_debut)->format('d/m/Y H:i') : '—' }}
                    </div>
                </div>

                <div>
                    <div class="mini-label">Statut</div>
                    <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $reservationStudio->statut)) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection