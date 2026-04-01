@extends('back.layouts.principal')

@section('title', 'Liens sociaux')
@section('page_title', 'Liens sociaux')
@section('page_subtitle', 'Gestion des liens de réseaux sociaux et des points de présence web du hub.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Liste des liens sociaux</h4>
                <p class="text-muted mb-0">Contrôle des liens affichés dans le header, le footer ou partout sur le front.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.medias.liens-sociaux.header') }}" class="btn btn-outline-primary rounded-pill px-4">Header</a>
                <a href="{{ route('back.medias.liens-sociaux.footer') }}" class="btn btn-outline-info rounded-pill px-4">Footer</a>
                <a href="{{ route('back.medias.liens-sociaux.actifs') }}" class="btn btn-outline-success rounded-pill px-4">Actifs</a>
                <a href="{{ route('back.medias.liens-sociaux.creer') }}" class="btn btn-primary rounded-pill px-4">Ajouter un lien</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Icône</th>
                        <th>URL</th>
                        <th>Emplacement</th>
                        <th>Ordre</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($liensSociaux as $lienSocial)
                        <tr>
                            <td>{{ $lienSocial->id }}</td>
                            <td>{{ $lienSocial->nom }}</td>
                            <td>
                                @if($lienSocial->icone)
                                    <i class="{{ $lienSocial->icone }}"></i>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-truncate" style="max-width: 220px;">{{ $lienSocial->url }}</td>
                            <td>{{ ucfirst($lienSocial->emplacement) }}</td>
                            <td>{{ $lienSocial->ordre_affichage }}</td>
                            <td>
                                @if($lienSocial->est_actif)
                                    <span class="badge rounded-pill text-bg-success">Actif</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('back.medias.liens-sociaux.details', $lienSocial) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.medias.liens-sociaux.modifier', $lienSocial) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-4 text-muted">Aucun lien social trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $liensSociaux->links() }}</div>
    </div>
@endsection