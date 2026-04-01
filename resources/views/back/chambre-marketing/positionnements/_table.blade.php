<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Segment cible</th>
                    <th>Canal principal</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($positionnements as $positionnement)
                    <tr>
                        <td>#{{ $positionnement->id }}</td>

                        <td>
                            <div class="fw-bold">{{ $positionnement->titre }}</div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit($positionnement->message_central, 70) }}
                            </div>
                        </td>

                        <td>{{ $positionnement->segment_cible ?: '—' }}</td>
                        <td>{{ $positionnement->canal_principal ?: '—' }}</td>

                        <td>
                            @php
                                $couleurStatut = match($positionnement->statut) {
                                    'actif' => 'success',
                                    'a_revoir' => 'warning',
                                    'archive' => 'dark',
                                    default => 'secondary'
                                };
                            @endphp

                            <span class="badge rounded-pill text-bg-{{ $couleurStatut }}">
                                {{ str_replace('_', ' ', ucfirst($positionnement->statut)) }}
                            </span>
                        </td>

                        <td>{{ $positionnement->auteur->name ?? '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-marketing.positionnements.details', $positionnement) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-marketing.positionnements.modifier', $positionnement) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                @if($positionnement->statut !== 'actif')
                                    <form method="POST" action="{{ route('back.chambre-marketing.positionnements.activer', $positionnement) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            Activer
                                        </button>
                                    </form>
                                @endif

                                @if($positionnement->statut !== 'a_revoir')
                                    <form method="POST" action="{{ route('back.chambre-marketing.positionnements.marquer_a_revoir', $positionnement) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                            À revoir
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('back.chambre-marketing.positionnements.supprimer', $positionnement) }}" class="d-inline"
                                      onsubmit="return confirm('Supprimer ce positionnement ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Aucun positionnement marketing trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $positionnements->links() }}
    </div>
</div>