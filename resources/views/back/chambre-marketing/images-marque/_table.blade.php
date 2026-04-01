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
                    <th>Marque</th>
                    <th>Slogan</th>
                    <th>Ton</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($imagesMarque as $image)
                    <tr>
                        <td>#{{ $image->id }}</td>

                        <td>
                            <div class="fw-bold">{{ $image->nom_marque }}</div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit($image->ligne_editoriale, 70) }}
                            </div>
                        </td>

                        <td>{{ $image->slogan ?: '—' }}</td>
                        <td>{{ $image->ton_marque ?: '—' }}</td>

                        <td>
                            @php
                                $couleurStatut = match($image->statut) {
                                    'active' => 'success',
                                    'obsolete' => 'warning',
                                    'archivee' => 'dark',
                                    default => 'secondary'
                                };
                            @endphp

                            <span class="badge rounded-pill text-bg-{{ $couleurStatut }}">
                                {{ ucfirst($image->statut) }}
                            </span>
                        </td>

                        <td>{{ $image->auteur->name ?? '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-marketing.images-marque.details', $image) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-marketing.images-marque.modifier', $image) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                @if($image->statut !== 'active')
                                    <form method="POST" action="{{ route('back.chambre-marketing.images-marque.activer', $image) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            Activer
                                        </button>
                                    </form>
                                @endif

                                @if($image->statut !== 'obsolete')
                                    <form method="POST" action="{{ route('back.chambre-marketing.images-marque.marquer_obsolete', $image) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                            Obsolète
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('back.chambre-marketing.images-marque.supprimer', $image) }}" class="d-inline"
                                      onsubmit="return confirm('Supprimer cette image de marque ?')">
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
                            Aucune image de marque trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $imagesMarque->links() }}
    </div>
</div>