<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Bibliothèque documentaire</h5>
                    <small class="text-muted">Règlements, politiques, conventions, chartes et textes légaux du hub.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Document</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Auteur</th>
                        <th>Fichier</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($documents as $document)
                        <tr>
                            <td>#{{ $document->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $document->titre }}</div>
                                <div class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($document->contenu), 70) ?: 'Sans contenu résumé.' }}
                                </div>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $document->categorie)) }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $badge = match($document->statut) {
                                        'brouillon' => 'secondary',
                                        'actif' => 'success',
                                        'archive' => 'dark',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst($document->statut) }}
                                </span>
                            </td>

                            <td>{{ $document->auteur->name ?? '—' }}</td>

                            <td>
                                @if($document->fichier)
                                    <span class="small text-muted">Disponible</span>
                                @else
                                    <span class="small text-muted">—</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.documents.details', $document) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.documents.modifier', $document) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsDocument{{ $document->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.documents._modales', ['document' => $document])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Aucun document juridique trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $documents->links() }}
        </div>
    </div>
</div>
