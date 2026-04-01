@extends('back.layouts.principal')

@section('title', 'Départements')
@section('page_title', 'Départements')
@section('page_subtitle', 'Gestion des unités d’organisation et des branches internes du hub.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Liste des départements</h4>
                <p class="text-muted mb-0">Vue globale des structures internes.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.equipe.departements.actifs') }}" class="btn btn-outline-success rounded-pill px-4">Actifs</a>
                <a href="{{ route('back.equipe.departements.inactifs') }}" class="btn btn-outline-secondary rounded-pill px-4">Inactifs</a>
                <a href="{{ route('back.equipe.departements.creer') }}" class="btn btn-primary rounded-pill px-4">Ajouter un département</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Département</th>
                        <th>Postes</th>
                        <th>Membres</th>
                        <th>Messages</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departements as $departement)
                        <tr>
                            <td>{{ $departement->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $departement->nom }}</div>
                                <div class="text-muted small">{{ $departement->slug }}</div>
                            </td>
                            <td>{{ $departement->postes_count }}</td>
                            <td>{{ $departement->membres_count }}</td>
                            <td>{{ $departement->messages_internes_count }}</td>
                            <td>
                                @if($departement->est_actif)
                                    <span class="badge rounded-pill text-bg-success">Actif</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('back.equipe.departements.details', $departement) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.equipe.departements.modifier', $departement) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4 text-muted">Aucun département trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $departements->links() }}</div>
    </div>
@endsection