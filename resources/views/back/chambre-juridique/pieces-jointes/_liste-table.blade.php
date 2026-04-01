<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Registre des pièces jointes</h5>
                    <small class="text-muted">Suivi transversal des annexes, scans, preuves, justificatifs et documents liés.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pièce</th>
                        <th>Type</th>
                        <th>Liaison</th>
                        <th>Auteur</th>
                        <th>Fichier</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pieces as $piece)
                        <tr>
                            <td>#{{ $piece->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $piece->titre }}</div>
                                <div class="small text-muted">
                                    {{ $piece->contrat?->titre ?? $piece->engagement?->nom_complet ?? $piece->dossier?->titre ?? $piece->archive?->titre ?? 'Aucune liaison claire' }}
                                </div>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $piece->type_piece)) }}
                                </span>
                            </td>

                            <td>
                                @if($piece->contrat)
                                    <span class="badge text-bg-primary">Contrat</span>
                                @elseif($piece->engagement)
                                    <span class="badge text-bg-info">Engagement</span>
                                @elseif($piece->dossier)
                                    <span class="badge text-bg-warning">Dossier</span>
                                @elseif($piece->archive)
                                    <span class="badge text-bg-secondary">Archive</span>
                                @else
                                    <span class="badge text-bg-light border text-dark">Non liée</span>
                                @endif
                            </td>

                            <td>{{ $piece->auteur->name ?? '—' }}</td>

                            <td>
                                @if($piece->fichier)
                                    <span class="small text-muted">Disponible</span>
                                @else
                                    <span class="small text-muted">—</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.pieces-jointes.details', $piece) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.pieces-jointes.modifier', $piece) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsPiece{{ $piece->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.pieces-jointes._modales', ['piece' => $piece])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Aucune pièce jointe trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $pieces->links() }}
        </div>
    </div>
</div>