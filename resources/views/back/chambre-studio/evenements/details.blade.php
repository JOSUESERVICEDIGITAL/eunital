@extends('back.layouts.app')

@section('content')
<div class="container">

    <div class="card shadow border-0">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <div>
                    <h3 class="mb-1">{{ $evenementStudio->titre }}</h3>
                    <div class="text-muted">
                        {{ $evenementStudio->client->nom ?? 'Client inconnu' }}
                    </div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('back.chambre-studio.evenements.modifier', $evenementStudio) }}"
                       class="btn btn-primary">
                        Modifier
                    </a>

                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalActionsEvenement{{ $evenementStudio->id }}">
                        Actions
                    </button>
                </div>
            </div>

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="p-3 rounded border bg-light">
                        <div class="small text-muted">Type</div>
                        <div class="fw-semibold">{{ $evenementStudio->type ?: '—' }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border bg-light">
                        <div class="small text-muted">Date</div>
                        <div class="fw-semibold">
                            {{ $evenementStudio->date ? $evenementStudio->date->format('d/m/Y') : '—' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded border bg-light">
                        <div class="small text-muted">Statut</div>
                        <div class="fw-semibold">{{ ucfirst($evenementStudio->statut) }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 rounded border bg-light">
                        <div class="small text-muted">Lieu</div>
                        <div class="fw-semibold">{{ $evenementStudio->lieu ?: '—' }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 rounded border bg-light">
                        <div class="small text-muted mb-2">Captations liées</div>

                        @forelse($evenementStudio->captations as $captation)
                            <div class="border rounded p-2 mb-2 bg-white">
                                <div class="fw-semibold">{{ $captation->titre }}</div>
                                <div class="small text-muted">
                                    {{ $captation->date ? $captation->date->format('d/m/Y') : '—' }} ·
                                    {{ ucfirst($captation->statut) }}
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">Aucune captation liée.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            @include('back.chambre-studio.evenements._modales', ['evenementStudio' => $evenementStudio])

        </div>
    </div>

</div>
@endsection