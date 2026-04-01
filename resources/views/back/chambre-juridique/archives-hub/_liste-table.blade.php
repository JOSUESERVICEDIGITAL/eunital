<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Mémoire documentaire du hub</h5>
                    <small class="text-muted">Pièces historiques, visuelles et institutionnelles conservées dans le patrimoine du hub.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Archive</th>
                        <th>Catégorie</th>
                        <th>Type fichier</th>
                        <th>Visibilité</th>
                        <th>Date archive</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($archives as $archive)
                        <tr>
                            <td>#{{ $archive->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $archive->titre }}</div>
                                <div class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit($archive->description, 70) ?: 'Sans description.' }}
                                </div>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst(str_replace('_', ' ', $archive->categorie)) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst($archive->type_fichier) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge text-bg-{{ $archive->visible ? 'success' : 'secondary' }}">
                                    {{ $archive->visible ? 'Visible' : 'Masquée' }}
                                </span>
                            </td>

                            <td>
                                {{ $archive->date_archive ? \Carbon\Carbon::parse($archive->date_archive)->format('d/m/Y') : '—' }}
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.archives-hub.details', $archive) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.archives-hub.modifier', $archive) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsArchive{{ $archive->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.archives-hub._modales', ['archive' => $archive])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Aucune archive trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $archives->links() }}
        </div>
    </div>
</div>