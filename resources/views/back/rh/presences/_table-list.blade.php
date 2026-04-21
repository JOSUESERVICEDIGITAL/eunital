<div class="content-card">
    <div class="table-head-custom mb-4">
        <div>
            <h5 class="mb-1 fw-bold">{{ $pageTitleInner }}</h5>
            <p class="text-muted mb-0">{{ $description }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employé</th>
                    <th>Département</th>
                    <th>Date</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Statut</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($presencesList as $presence)
                    <tr>
                        <td>{{ $presence->id }}</td>
                        <td>{{ optional($presence->membreEquipe)->nom }} {{ optional($presence->membreEquipe)->prenom }}</td>
                        <td>{{ optional(optional($presence->membreEquipe)->departement)->nom ?? '—' }}</td>
                        <td>{{ $presence->date_presence?->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ $presence->heure_arrivee ?? '—' }}</td>
                        <td>{{ $presence->heure_depart ?? '—' }}</td>
                        <td>
                            <span class="badge rounded-pill text-bg-light border">
                                {{ ucfirst(str_replace('_', ' ', $presence->statut)) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('rh.presences.show', $presence) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                Voir
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="empty-state">
                                <i class="fa-solid fa-clock empty-state-icon"></i>
                                <h5 class="mt-3">Aucune donnée</h5>
                                <p class="text-muted">Aucun enregistrement disponible pour cette vue.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($presencesList, 'links'))
        <div class="mt-4">
            {{ $presencesList->links() }}
        </div>
    @endif
</div>

<style>
    .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
    .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
    .custom-table tbody td{border-bottom:1px solid #f1f5f9}
    .empty-state{text-align:center;padding:20px}
    .empty-state-icon{font-size:42px;color:#94a3b8}
</style>