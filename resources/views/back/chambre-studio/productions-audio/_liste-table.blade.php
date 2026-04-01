<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <div class="mini-label">Suivi opérationnel</div>
            <h5 class="mb-0">Liste des productions audio</h5>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
            <thead class="table-head-custom">
                <tr>
                    <th>#</th>
                    <th>Session</th>
                    <th>Client</th>
                    <th>Projet</th>
                    <th>Type</th>
                    <th>Durée</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($audios as $audio)
                    @php
                        $badge = match($audio->statut) {
                            'enregistrement' => 'primary',
                            'mixage' => 'warning',
                            'mastering' => 'info',
                            'livre' => 'success',
                            'archive' => 'dark',
                            default => 'secondary'
                        };

                        $statusLabel = match($audio->statut) {
                            'enregistrement' => 'Enregistrement',
                            'mixage' => 'Mixage',
                            'mastering' => 'Mastering',
                            'livre' => 'Livrée',
                            'archive' => 'Archivée',
                            default => ucfirst($audio->statut)
                        };
                    @endphp

                    <tr>
                        <td class="fw-semibold text-muted">#{{ $audio->id }}</td>

                        <td>
                            <div class="d-flex align-items-start gap-3">
                                <div class="table-avatar">
                                    <i class="fa-solid fa-music"></i>
                                </div>

                                <div>
                                    <div class="fw-bold">{{ $audio->titre }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($audio->description ?: 'Aucune description fournie.', 80) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $audio->client->nom ?? '—' }}</div>
                            <div class="small text-muted">{{ $audio->client->telephone ?? 'Aucun téléphone' }}</div>
                        </td>

                        <td>{{ $audio->projet->titre ?? '—' }}</td>

                        <td>
                            <span class="badge bg-light text-dark border rounded-pill">
                                {{ ucfirst($audio->type) }}
                            </span>
                        </td>

                        <td>{{ $audio->duree ?? '—' }}</td>

                        <td>
                            <span class="badge bg-{{ $badge }} rounded-pill px-3">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        <td>{{ $audio->auteur->name ?? '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-studio.productions-audio.details', $audio) }}"
                                    class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-studio.productions-audio.modifier', $audio) }}"
                                    class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalActionsAudio{{ $audio->id }}">
                                    Actions
                                </button>
                            </div>

                            @include('back.chambre-studio.productions-audio._modales', ['audio' => $audio])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fa-solid fa-music"></i>
                                </div>
                                <h6 class="mb-1">Aucune production audio trouvée</h6>
                                <p class="text-muted mb-3">Commence par créer une nouvelle session audio pour alimenter la chambre studio.</p>
                                <a href="{{ route('back.chambre-studio.productions-audio.creer') }}"
                                    class="btn btn-dark rounded-pill px-4">
                                    <i class="fa-solid fa-plus me-1"></i> Nouvelle session
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $audios->links() }}
    </div>
</div>