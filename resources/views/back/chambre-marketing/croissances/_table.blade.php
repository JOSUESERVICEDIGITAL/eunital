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
                    <th>Action</th>
                    <th>Objectif</th>
                    <th>Levier</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th>Responsable</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($croissances as $croissance)
                    <tr>
                        <td>#{{ $croissance->id }}</td>

                        <td>
                            <div class="fw-bold">{{ $croissance->titre }}</div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit($croissance->action_prevue, 70) }}
                            </div>
                        </td>

                        <td>{{ $croissance->objectif ?: '—' }}</td>
                        <td>{{ $croissance->levier ?: '—' }}</td>

                        <td>
                            @php
                                $couleurPriorite = match($croissance->priorite) {
                                    'critique' => 'danger',
                                    'haute' => 'warning',
                                    'moyenne' => 'primary',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge rounded-pill text-bg-{{ $couleurPriorite }}">
                                {{ ucfirst($croissance->priorite) }}
                            </span>
                        </td>

                        <td>
                            @php
                                $couleurStatut = match($croissance->statut) {
                                    'en_cours' => 'primary',
                                    'test' => 'warning',
                                    'validee' => 'success',
                                    'abandonnee' => 'secondary',
                                    'archivee' => 'dark',
                                    default => 'light'
                                };
                            @endphp
                            <span class="badge rounded-pill text-bg-{{ $couleurStatut }}">
                                {{ str_replace('_', ' ', ucfirst($croissance->statut)) }}
                            </span>
                        </td>

                        <td>{{ $croissance->responsable->name ?? '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-marketing.croissances.details', $croissance) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-marketing.croissances.modifier', $croissance) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                @if($croissance->statut !== 'en_cours')
                                    <form method="POST" action="{{ route('back.chambre-marketing.croissances.lancer', $croissance) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            Lancer
                                        </button>
                                    </form>
                                @endif

                                @if($croissance->priorite !== 'critique')
                                    <form method="POST" action="{{ route('back.chambre-marketing.croissances.definir_priorite_critique', $croissance) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            Critique
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('back.chambre-marketing.croissances.supprimer', $croissance) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Supprimer cette action de croissance ?')">
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
                        <td colspan="8" class="text-center py-5 text-muted">
                            Aucune action de croissance trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $croissances->links() }}
    </div>
</div>