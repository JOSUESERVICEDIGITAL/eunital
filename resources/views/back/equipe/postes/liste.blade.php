@extends('back.layouts.principal')

@section('title', 'Postes')
@section('page_title', 'Fonctions et postes')
@section('page_subtitle', 'Gestion des fonctions et positions organisationnelles du hub.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Liste des postes</h4>
                <p class="text-muted mb-0">Vue globale des postes attribuables.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.equipe.postes.actifs') }}" class="btn btn-outline-success rounded-pill px-4">Actifs</a>
                <a href="{{ route('back.equipe.postes.inactifs') }}" class="btn btn-outline-secondary rounded-pill px-4">Inactifs</a>
                <a href="{{ route('back.equipe.postes.creer') }}" class="btn btn-primary rounded-pill px-4">Ajouter un poste</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Poste</th>
                        <th>Département</th>
                        <th>Membres</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($postes as $poste)
                        <tr>
                            <td>{{ $poste->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $poste->nom }}</div>
                                <div class="text-muted small">{{ $poste->slug }}</div>
                            </td>
                            <td>{{ $poste->departement->nom ?? 'Non défini' }}</td>
                            <td>{{ $poste->membres_count }}</td>
                            <td>
                                @if($poste->est_actif)
                                    <span class="badge rounded-pill text-bg-success">Actif</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('back.equipe.postes.details', $poste) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.equipe.postes.modifier', $poste) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">Aucun poste trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $postes->links() }}</div>
    </div>
@endsection