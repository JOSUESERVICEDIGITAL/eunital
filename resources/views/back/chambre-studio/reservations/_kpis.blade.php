@php
    $total = $reservations->count();
    $reservees = $reservations->where('statut', 'reserve')->count();
    $confirmees = $reservations->where('statut', 'confirme')->count();
    $annulees = $reservations->where('statut', 'annule')->count();

    $aujourdhui = $reservations->filter(function ($reservation) {
        return optional($reservation->date_debut)?->format('Y-m-d') === now()->format('Y-m-d');
    })->count();

    $avecSalle = $reservations->filter(fn($reservation) => !empty($reservation->salle))->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Réservations</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
        <div class="text-muted small">Total des réservations studio enregistrées.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Réservées</div>
                <div class="stat-number">{{ $reservees }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
        <div class="text-muted small">Réservations en attente de confirmation.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Confirmées</div>
                <div class="stat-number">{{ $confirmees }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="text-muted small">Réservations validées et maintenues.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Annulées</div>
                <div class="stat-number">{{ $annulees }}</div>
            </div>
            <div class="stat-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-ban"></i>
            </div>
        </div>
        <div class="text-muted small">Réservations annulées ou interrompues.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Aujourd’hui</div>
                <div class="stat-number">{{ $aujourdhui }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-calendar-day"></i>
            </div>
        </div>
        <div class="text-muted small">Réservations prévues pour la journée en cours.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec salle</div>
                <div class="stat-number">{{ $avecSalle }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-door-open"></i>
            </div>
        </div>
        <div class="text-muted small">Réservations avec salle renseignée.</div>
    </div>
</div>