@extends('back.juridique.layouts.app')
@section('title', $contrat->reference)
@section('page_title', $contrat->reference)
@section('page_subtitle', 'Détails du contrat')

@section('juridique-content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations générales</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Référence</dt><dd class="col-sm-8"><code>{{ $contrat->reference }}</code></dd>
                    <dt class="col-sm-4">Document lié</dt><dd class="col-sm-8"><a href="{{ route('back.juridique.documents.show', $contrat->document) }}">{{ $contrat->document->titre }}</a></dd>
                    <dt class="col-sm-4">Type de contrat</dt><dd class="col-sm-8">@include('back.juridique.partials.status-badge', ['status' => $contrat->type_contrat])</dd>
                    <dt class="col-sm-4">Date de début</dt><dd class="col-sm-8">{{ $contrat->date_debut->format('d/m/Y') }}</dd>
                    <dt class="col-sm-4">Date de fin</dt><dd class="col-sm-8">{{ $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : 'Indéterminée' }}</dd>
                    @if($contrat->date_fin)<dt class="col-sm-4">Jours restants</dt><dd class="col-sm-8">{{ now()->diffInDays($contrat->date_fin, false) }} jours</dd>@endif
                    <dt class="col-sm-4">Montant</dt><dd class="col-sm-8">{{ $contrat->montant ? number_format($contrat->montant, 2) . ' ' . $contrat->devise : 'Non défini' }}</dd>
                    <dt class="col-sm-4">Renouvellement</dt><dd class="col-sm-8">{{ $contrat->renouvellement_auto ? 'Automatique (tous les ' . $contrat->duree_renouvellement . ' jours)' : 'Non renouvelable' }}</dd>
                    <dt class="col-sm-4">Préavis</dt><dd class="col-sm-8">{{ $contrat->duree_preavis ? $contrat->duree_preavis . ' jours' : 'Non défini' }}</dd>
                </dl>
                <hr><h6>Objet</h6><p>{{ $contrat->objet }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('back.juridique.contrats.edit', $contrat) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                <a href="{{ route('back.juridique.contrats.pdf', $contrat) }}" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
                @if($contrat->renouvellement_auto)<button onclick="renouvelerContrat({{ $contrat->id }})" class="btn btn-success"><i class="fas fa-sync-alt"></i> Renouveler</button>@endif
                <a href="{{ route('back.juridique.contrats.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-file-contract"></i> Conditions et clauses</h3></div>
            <div class="card-body">
                <h6>Conditions particulières</h6>
                <ul>
                    @foreach($contrat->conditions ?? [] as $condition)
                    <li>{{ $condition }}</li>
                    @endforeach
                </ul>
                <h6>Clauses spécifiques</h6>
                <ul>
                    @foreach($contrat->clauses ?? [] as $clause)
                    <li>{{ $clause }}</li>
                    @endforeach
                </ul>
                @if($contrat->penalites)
                <h6 class="text-danger">Pénalités</h6>
                <ul>
                    @foreach($contrat->penalites ?? [] as $penalite)
                    <li>{{ $penalite }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-users"></i> Parties prenantes</h3></div>
            <div class="card-body">
                <div class="row">
                    @foreach($contrat->document->entreprises as $entreprise)
                    <div class="col-md-6 mb-2">
                        <div class="border rounded p-2">
                            <strong>{{ $entreprise->nom }}</strong><br>
                            <small>{{ $entreprise->siret_formate }}</small><br>
                            <span class="badge badge-info">{{ $entreprise->pivot->role }}</span>
                        </div>
                    </div>
                    @endforeach
                    @foreach($contrat->document->utilisateurs as $user)
                    <div class="col-md-6 mb-2">
                        <div class="border rounded p-2">
                            <strong>{{ $user->name }}</strong><br>
                            <small>{{ $user->email }}</small><br>
                            <span class="badge badge-info">{{ $user->pivot->role }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('juridique-scripts')
<script>
function renouvelerContrat(id) {
    Swal.fire({ title: 'Renouvellement', text: 'Confirmez-vous le renouvellement ?', icon: 'question', showCancelButton: true, confirmButtonColor: '#28a745' }).then((result) => {
        if (result.isConfirmed) { $.ajax({ url: '/back/juridique/contrats/' + id + '/renouveler', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' }, success: function(r) { if(r.success) location.reload(); } }); }
    });
}
</script>
@endpush