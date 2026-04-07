@extends('back.juridique.layouts.app')
@section('title', 'Détails conformité')
@section('page_title', 'Évaluation de conformité')
@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informations</h3></div>
            <div class="card-body">
                <dl><dt>Texte légal</dt><dd><a href="{{ route('back.juridique.legalites.show', $conformite->legalite) }}">{{ $conformite->legalite->titre }}</a></dd>
                <dt>Entreprise</dt><dd>{{ $conformite->entreprise->nom ?? '-' }}</dd>
                <dt>Statut</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $conformite->statut])</dd>
                <dt>Score</dt><dd><div class="progress"><div class="progress-bar bg-{{ $conformite->score_conformite >= 80 ? 'success' : ($conformite->score_conformite >= 60 ? 'warning' : 'danger') }}" style="width: {{ $conformite->score_conformite ?? 0 }}%">{{ $conformite->score_conformite ?? 0 }}%</div></div></dd>
                <dt>Date contrôle</dt><dd>{{ $conformite->date_controle ? $conformite->date_controle->format('d/m/Y') : 'Non défini' }}</dd>
                <dt>Prochaine évaluation</dt><dd>{{ $conformite->date_prochaine_evaluation ? $conformite->date_prochaine_evaluation->format('d/m/Y') : 'Non définie' }}</dd>
                <dt>Commentaires</dt><dd>{{ $conformite->commentaires ?? 'Aucun' }}</dd></dl>
            </div>
            <div class="card-footer"><a href="{{ route('back.juridique.conformites.edit', $conformite) }}" class="btn btn-warning">Modifier</a><a href="{{ route('back.juridique.conformites.plan-action', $conformite) }}" class="btn btn-info">Plan d'action</a><a href="{{ route('back.juridique.conformites.index') }}" class="btn btn-secondary">Retour</a></div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-header">Évaluations détaillées</div><div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead><tr><th>Critère</th><th>Statut</th><th>Commentaire</th></tr></thead>
                    <tbody>
                        @foreach($conformite->evaluations ?? [] as $eval)
                        <tr><td>{{ $eval['critere'] ?? '-' }}</td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $eval['statut'] ?? 'en_cours'])</td>
                        <td>{{ $eval['commentaire'] ?? '-' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div></div>
        <div class="card mt-3"><div class="card-header">Actions correctives</div><div class="card-body">
            <div class="list-group">
                @forelse($conformite->actions_correctives ?? [] as $action)
                <div class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $action['action'] ?? '' }}</strong>
                        <span class="badge badge-{{ $action['statut'] == 'termine' ? 'success' : 'warning' }}">{{ $action['statut'] ?? 'En cours' }}</span>
                    </div>
                    <small>Responsable: {{ $action['responsable'] ?? '-' }} | Date limite: {{ $action['date_limite'] ?? '-' }}</small>
                    @if(($action['statut'] ?? '') != 'termine')
                    <button class="btn btn-sm btn-success float-right" onclick="terminerAction({{ $loop->index }})">Terminer</button>
                    @endif
                </div>
                @empty
                <div class="text-center py-3">Aucune action corrective</div>
                @endforelse
            </div>
        </div></div>
    </div>
</div>
@endsection

@push('juridique-scripts')
<script>
function terminerAction(index) {
    Swal.fire({ title: 'Action terminée', text: 'Confirmez-vous la réalisation de cette action ?', icon: 'question', showCancelButton: true, confirmButtonColor: '#28a745', confirmButtonText: 'Oui, terminer' }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({ url: '{{ route("back.juridique.conformites.terminer-action", $conformite) }}', method: 'POST', data: { _token: '{{ csrf_token() }}', index: index }, success: function(r) { if(r.success) location.reload(); } });
        }
    });
}
</script>
@endpush