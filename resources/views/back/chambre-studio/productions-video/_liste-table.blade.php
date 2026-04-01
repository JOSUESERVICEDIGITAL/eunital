<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Pipeline vidéo</h5>
                    <small class="text-muted">Gestion complète du tournage jusqu’à la livraison finale.</small>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-studio.productions-video.creer') }}"
                       class="btn btn-sm btn-dark rounded-pill px-3">
                        + Nouvelle production
                    </a>

                    <a href="{{ route('back.chambre-studio.dashboard') }}"
                       class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        Dashboard studio
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0 studio-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Production</th>
                        <th>Client</th>
                        <th>Projet</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Auteur</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($videos as $video)
                        @php
                            $badge = match($video->statut) {
                                'tournage' => 'primary',
                                'montage' => 'warning',
                                'validation' => 'info',
                                'livre' => 'success',
                                'archive' => 'dark',
                                default => 'secondary'
                            };

                            $statusLabel = match($video->statut) {
                                'tournage' => 'Tournage',
                                'montage' => 'Montage',
                                'validation' => 'Validation',
                                'livre' => 'Livrée',
                                'archive' => 'Archivée',
                                default => ucfirst($video->statut)
                            };
                        @endphp

                        <tr>
                            <td>
                                <span class="fw-semibold text-muted">#{{ $video->id }}</span>
                            </td>

                            <td>
                                <div class="d-flex align-items-start gap-3">
                                    <div class="studio-thumb-icon">
                                        <i class="fa-solid fa-film"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold text-dark">{{ $video->titre }}</div>

                                        <div class="small text-muted mt-1">
                                            {{ \Illuminate\Support\Str::limit($video->description ?: 'Aucune description fournie.', 75) }}
                                        </div>

                                        <div class="small mt-2">
                                            @if($video->type === 'mariage')
                                                <span class="badge rounded-pill text-bg-danger-subtle border text-danger-emphasis">Mariage</span>
                                            @elseif($video->type === 'clip')
                                                <span class="badge rounded-pill text-bg-primary-subtle border text-primary-emphasis">Clip</span>
                                            @elseif($video->type === 'spot')
                                                <span class="badge rounded-pill text-bg-warning-subtle border text-warning-emphasis">Spot</span>
                                            @elseif($video->type === 'interview')
                                                <span class="badge rounded-pill text-bg-info-subtle border text-info-emphasis">Interview</span>
                                            @else
                                                <span class="badge rounded-pill text-bg-light border">{{ ucfirst($video->type) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $video->client->nom ?? '—' }}</div>
                                <div class="small text-muted">{{ $video->client->telephone ?? 'Aucun téléphone' }}</div>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $video->projet->titre ?? '—' }}</div>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst($video->type) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge text-bg-{{ $badge }} rounded-pill px-3">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $video->auteur->name ?? '—' }}</div>
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-studio.productions-video.details', $video) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-studio.productions-video.modifier', $video) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsVideo{{ $video->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-studio.productions-video._modales', ['video' => $video])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="fa-solid fa-photo-film fs-2 opacity-50"></i>
                                    <div>Aucune production vidéo trouvée.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 bg-white border-top">
            {{ $videos->links() }}
        </div>
    </div>
</div>

<style>
    .studio-table tbody tr:hover{
        background: rgba(15, 23, 42, 0.025);
    }

    .studio-thumb-icon{
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        color: #dc2626;
        border: 1px solid #e5e7eb;
        flex-shrink: 0;
        font-size: 18px;
    }
</style>