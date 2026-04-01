@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h3 class="mb-1">{{ $contrat->titre }}</h3>
                    <p class="text-muted mb-2">Référence : {{ $contrat->reference }}</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge text-bg-light border">{{ ucfirst($contrat->type_contrat) }}</span>
                        <span class="badge text-bg-secondary">{{ ucfirst(str_replace('_',' ', $contrat->statut)) }}</span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('back.chambre-juridique.contrats.modifier', $contrat) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-dark rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsContrat{{ $contrat->id }}">
                        Actions
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Contenu du contrat</h5>
                    <div class="text-muted" style="white-space: pre-line;">
                        {{ $contrat->contenu ?: 'Aucun contenu renseigné.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Informations</h5>

                    <div class="mb-3">
                        <small class="text-muted d-block">Partie liée</small>
                        <strong>{{ ucfirst($contrat->partie_type) }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Client / utilisateur</small>
                        <strong>{{ $contrat->client->nom ?? $contrat->user->name ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Projet</small>
                        <strong>{{ $contrat->projet->titre ?? '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Montant</small>
                        <strong>{{ $contrat->montant ? number_format($contrat->montant, 0, ',', ' ') . ' FCFA' : '—' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Période</small>
                        <strong>
                            {{ $contrat->date_debut ? \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') : '—' }}
                            -
                            {{ $contrat->date_fin ? \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') : '—' }}
                        </strong>
                    </div>

                    @if($contrat->fichier_pdf)
                        <a href="{{ asset('storage/' . $contrat->fichier_pdf) }}"
                           target="_blank"
                           class="btn btn-outline-dark rounded-pill w-100">
                            Télécharger le PDF
                        </a>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Notes internes</h5>
                    <div class="text-muted">
                        {{ $contrat->notes ?: 'Aucune note.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('back.chambre-juridique.contrats._modales', ['contrat' => $contrat])
@endsection
