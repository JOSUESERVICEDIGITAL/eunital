<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
        <a href="{{ route('back.equipe.messages.tous') }}" class="btn btn-outline-dark rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sujet</th>
                    <th>Expéditeur</th>
                    <th>Destinataire</th>
                    <th>Type</th>
                    <th>Lecture</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $messageInterne)
                    <tr>
                        <td>{{ $messageInterne->id }}</td>
                        <td>{{ $messageInterne->sujet }}</td>
                        <td>{{ $messageInterne->expediteur?->nom }} {{ $messageInterne->expediteur?->prenom }}</td>
                        <td>{{ $messageInterne->destinataire ? $messageInterne->destinataire->nom . ' ' . $messageInterne->destinataire->prenom : '—' }}</td>
                        <td>{{ ucfirst($messageInterne->type_message) }}</td>
                        <td>{{ $messageInterne->est_lu ? 'Lu' : 'Non lu' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Aucun message trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $messages->links() }}</div>
</div>