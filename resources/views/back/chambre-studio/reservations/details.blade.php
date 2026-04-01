@extends('back.layouts.principal')

@section('title', 'Détails réservation studio')
@section('page_title', 'Fiche détaillée · Réservation studio')
@section('page_subtitle', 'Consulte les informations complètes d’une réservation studio et ses actions métier.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <div>
                        <div class="mini-label">Réservation studio</div>
                        <h4 class="mb-0">{{ $reservationStudio->client->nom ?? 'Client studio' }}</h4>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('back.chambre-studio.reservations.modifier', $reservationStudio) }}"
                           class="btn btn-outline-dark rounded-pill px-3">
                            Modifier
                        </a>

                        <button type="button"
                                class="btn btn-dark rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalActionsReservationStudio{{ $reservationStudio->id }}">
                            Centre réservation
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Client</div>
                            <div class="fw-semibold">{{ $reservationStudio->client->nom ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Salle</div>
                            <div class="fw-semibold">{{ $reservationStudio->salle ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Statut</div>
                            <div class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $reservationStudio->statut)) }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Date de début</div>
                            <div class="fw-semibold">
                                {{ $reservationStudio->date_debut ? \Carbon\Carbon::parse($reservationStudio->date_debut)->format('d/m/Y H:i') : '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-card bg-light border h-100">
                            <div class="mini-label">Date de fin</div>
                            <div class="fw-semibold">
                                {{ $reservationStudio->date_fin ? \Carbon\Carbon::parse($reservationStudio->date_fin)->format('d/m/Y H:i') : '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="content-card bg-light border">
                            <div class="mini-label">Créée le</div>
                            <div class="fw-semibold">
                                {{ $reservationStudio->created_at ? $reservationStudio->created_at->format('d/m/Y H:i') : '—' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="mini-label">Actions métier</div>
                <h5 class="mb-3">Traitement réservation</h5>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('back.chambre-studio.reservations.confirmer', $reservationStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success rounded-pill w-100">Confirmer</button>
                    </form>

                    <form method="POST" action="{{ route('back.chambre-studio.reservations.annuler', $reservationStudio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger rounded-pill w-100">Annuler</button>
                    </form>

                    <a href="{{ route('back.chambre-studio.reservations.toutes') }}" class="btn btn-light rounded-pill w-100">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('back.chambre-studio.reservations._modales', ['reservationStudio' => $reservationStudio])
@endsection