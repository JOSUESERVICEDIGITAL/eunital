<div class="content-card">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('back.chambre-developpement.depots-versions.tous') }}"
               class="btn btn-outline-dark rounded-pill px-4">
                Tous
            </a>

            <a href="{{ route('back.chambre-developpement.depots-versions.actifs') }}"
               class="btn btn-outline-success rounded-pill px-4">
                Actifs
            </a>

            <a href="{{ route('back.chambre-developpement.depots-versions.deployes') }}"
               class="btn btn-outline-primary rounded-pill px-4">
                Déployés
            </a>

            <a href="{{ route('back.chambre-developpement.depots-versions.hotfix') }}"
               class="btn btn-outline-danger rounded-pill px-4">
                Hotfix
            </a>

            <a href="{{ route('back.chambre-developpement.depots-versions.creer') }}"
               class="btn btn-primary rounded-pill px-4">
                <i class="fa fa-plus me-1"></i> Nouveau dépôt
            </a>

        </div>
    </div>


    {{-- ================= TABLE ================= --}}
    <div class="table-responsive">
        <table class="table align-middle custom-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Dépôt</th>
                    <th>Branche</th>
                    <th>Version</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($depots as $depot)
                    <tr>

                        {{-- ID --}}
                        <td class="fw-semibold text-muted">
                            #{{ $depot->id }}
                        </td>

                        {{-- DEPOT --}}
                        <td>
                            <div class="fw-bold">{{ $depot->titre }}</div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit($depot->description, 60) }}
                            </div>
                        </td>

                        {{-- BRANCHE --}}
                        <td>
                            <span class="badge rounded-pill bg-light border text-dark px-3">
                                <i class="fa fa-code-branch me-1"></i>
                                {{ $depot->branche_principale ?? 'main' }}
                            </span>
                        </td>

                        {{-- VERSION --}}
                        <td>
                            <span class="badge rounded-pill bg-dark text-white px-3">
                                v{{ $depot->version_actuelle }}
                            </span>
                        </td>

                        {{-- TYPE VERSION --}}
                        <td>
                            <span class="badge rounded-pill bg-light border px-3">
                                {{ ucfirst($depot->type_version) }}
                            </span>
                        </td>

                        {{-- STATUT --}}
                        <td>
                            @php
                                $colors = [
                                    'actif' => 'success',
                                    'deploie' => 'primary',
                                    'en_preparation' => 'warning',
                                    'gele' => 'secondary',
                                    'archive' => 'dark'
                                ];
                                $color = $colors[$depot->statut] ?? 'light';
                            @endphp

                            <span class="badge rounded-pill text-bg-{{ $color }} px-3">
                                {{ str_replace('_', ' ', ucfirst($depot->statut)) }}
                            </span>
                        </td>

                        {{-- AUTEUR --}}
                        <td>
                            <div class="small fw-semibold">
                                {{ $depot->auteur->name ?? '—' }}
                            </div>
                        </td>

                        {{-- ACTIONS --}}
                        <td class="text-end">

                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">

                                {{-- VOIR --}}
                                <a href="{{ route('back.chambre-developpement.depots-versions.details', $depot) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3"
                                   title="Voir">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {{-- MODIFIER --}}
                                <a href="{{ route('back.chambre-developpement.depots-versions.modifier', $depot) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3"
                                   title="Modifier">
                                    <i class="fa fa-pen"></i>
                                </a>

                                {{-- DEPLOYER (optionnel future) --}}
                                <button type="button"
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                    title="Déployer">
                                    <i class="fa fa-rocket"></i>
                                </button>

                                {{-- SUPPRIMER --}}
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionDepotVersion{{ $depot->id }}"
                                    title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </div>

                            {{-- MODALE --}}
                            @include('back.chambre-developpement.depots-versions._modales', [
                                'depot' => $depot
                            ])

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            🚫 Aucun dépôt ou version trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>


    {{-- ================= PAGINATION ================= --}}
    <div class="mt-4">
        {{ $depots->links() }}
    </div>

</div>
