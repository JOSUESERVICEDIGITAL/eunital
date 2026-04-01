<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.chambre-developpement.tests-techniques.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Tous</a>
            <a href="{{ route('back.chambre-developpement.tests-techniques.planifies') }}" class="btn btn-outline-secondary rounded-pill px-4">Planifiés</a>
            <a href="{{ route('back.chambre-developpement.tests-techniques.en_cours') }}" class="btn btn-outline-primary rounded-pill px-4">En cours</a>
            <a href="{{ route('back.chambre-developpement.tests-techniques.reussis') }}" class="btn btn-outline-success rounded-pill px-4">Réussis</a>
            <a href="{{ route('back.chambre-developpement.tests-techniques.echoues') }}" class="btn btn-outline-danger rounded-pill px-4">Échoués</a>
            <a href="{{ route('back.chambre-developpement.tests-techniques.creer') }}" class="btn btn-primary rounded-pill px-4">
                Nouveau test
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Test</th>
                    <th>Type</th>
                    <th>Résultat</th>
                    <th>Statut</th>
                    <th>Environnement</th>
                    <th>Auteur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tests as $test)
                    <tr>
                        <td>{{ $test->id }}</td>
                        <td>
                            <div class="fw-bold">{{ $test->titre }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($test->description, 70) }}</div>
                        </td>
                        <td>
                            <span class="badge rounded-pill text-bg-light border">
                                {{ ucfirst($test->type_test) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill
                                @if($test->resultat === 'reussi') text-bg-success
                                @elseif($test->resultat === 'echoue') text-bg-danger
                                @elseif($test->resultat === 'partiel') text-bg-warning
                                @else text-bg-secondary
                                @endif">
                                {{ str_replace('_', ' ', ucfirst($test->resultat)) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill text-bg-secondary">
                                {{ str_replace('_', ' ', ucfirst($test->statut)) }}
                            </span>
                        </td>
                        <td>{{ $test->environnement_test ?: '—' }}</td>
                        <td>{{ $test->auteur->name ?? '—' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-developpement.tests-techniques.details', $test) }}"
                                   class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-developpement.tests-techniques.modifier', $test) }}"
                                   class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button"
                                    class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionTestTechnique{{ $test->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-developpement.tests-techniques._modales', ['test' => $test])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            Aucun test technique trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tests->links() }}
    </div>
</div>
