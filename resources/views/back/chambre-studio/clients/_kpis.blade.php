@php
    $total = $clients->count();
    $artistes = $clients->where('type', 'artiste')->count();
    $entreprises = $clients->where('type', 'entreprise')->count();
    $particuliers = $clients->where('type', 'particulier')->count();
    $avecEmail = $clients->filter(fn($client) => !empty($client->email))->count();
    $avecTelephone = $clients->filter(fn($client) => !empty($client->telephone))->count();
@endphp

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Clients</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
            <div class="stat-icon bg-dark-subtle text-dark">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        <div class="text-muted small">Total des clients enregistrés dans la base studio.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Artistes</div>
                <div class="stat-number">{{ $artistes }}</div>
            </div>
            <div class="stat-icon bg-primary-subtle text-primary">
                <i class="fa-solid fa-microphone-lines"></i>
            </div>
        </div>
        <div class="text-muted small">Artistes, chanteurs, voix et talents créatifs.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Entreprises</div>
                <div class="stat-number">{{ $entreprises }}</div>
            </div>
            <div class="stat-icon bg-success-subtle text-success">
                <i class="fa-solid fa-building"></i>
            </div>
        </div>
        <div class="text-muted small">Structures, marques et organisations clientes.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Particuliers</div>
                <div class="stat-number">{{ $particuliers }}</div>
            </div>
            <div class="stat-icon bg-warning-subtle text-warning">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
        <div class="text-muted small">Clients particuliers pour événements et prestations privées.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec email</div>
                <div class="stat-number">{{ $avecEmail }}</div>
            </div>
            <div class="stat-icon bg-info-subtle text-info">
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>
        <div class="text-muted small">Clients disposant d’un contact email enregistré.</div>
    </div>
</div>

<div class="col-md-6 col-xl-2">
    <div class="content-card h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="mini-label">Avec téléphone</div>
                <div class="stat-number">{{ $avecTelephone }}</div>
            </div>
            <div class="stat-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-phone"></i>
            </div>
        </div>
        <div class="text-muted small">Clients avec numéro de téléphone disponible.</div>
    </div>
</div>