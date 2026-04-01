@extends('back.layouts.principal')

@section('title', 'Messages internes')
@section('page_title', 'Messages internes')
@section('page_subtitle', 'Communication interne entre membres, services et départements du hub.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1">Liste des messages</h4>
                <p class="text-muted mb-0">Vue centrale des communications internes.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('back.equipe.messages.recus') }}" class="btn btn-outline-info rounded-pill px-4">Reçus</a>
                <a href="{{ route('back.equipe.messages.envoyes') }}" class="btn btn-outline-primary rounded-pill px-4">Envoyés</a>
                <a href="{{ route('back.equipe.messages.annonces') }}" class="btn btn-outline-warning rounded-pill px-4">Annonces</a>
                <a href="{{ route('back.equipe.messages.creer') }}" class="btn btn-primary rounded-pill px-4">Nouveau message</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sujet</th>
                        <th>Expéditeur</th>
                        <th>Destinataire</th>
                        <th>Département</th>
                        <th>Type</th>
                        <th>Lecture</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $messageInterne)
                        <tr>
                            <td>{{ $messageInterne->id }}</td>
                            <td>
                                <div class="fw-bold">{{ $messageInterne->sujet }}</div>
                                <div class="text-muted small">{{ $messageInterne->date_envoi ? $messageInterne->date_envoi->format('d/m/Y H:i') : '' }}</div>
                            </td>
                            <td>{{ $messageInterne->expediteur?->nom }} {{ $messageInterne->expediteur?->prenom }}</td>
                            <td>{{ $messageInterne->destinataire ? $messageInterne->destinataire->nom . ' ' . $messageInterne->destinataire->prenom : '—' }}</td>
                            <td>{{ $messageInterne->departement->nom ?? '—' }}</td>
                            <td><span class="badge rounded-pill text-bg-light border">{{ ucfirst($messageInterne->type_message) }}</span></td>
                            <td>
                                @if($messageInterne->est_lu)
                                    <span class="badge rounded-pill text-bg-success">Lu</span>
                                @else
                                    <span class="badge rounded-pill text-bg-warning">Non lu</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('back.equipe.messages.details', $messageInterne) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                <a href="{{ route('back.equipe.messages.modifier', $messageInterne) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-4 text-muted">Aucun message trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $messages->links() }}</div>
    </div>
@endsection