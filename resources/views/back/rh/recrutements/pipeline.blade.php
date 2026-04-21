@extends('back.layouts.principal')

@section('title', 'Pipeline du recrutement')
@section('page_title', 'Pipeline du recrutement')
@section('page_subtitle', 'Visualise le flux candidat par étape pour suivre la progression réelle du recrutement.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $recrutement->titre }}</h4>
                        <p class="text-muted mb-0">Pipeline opérationnel des candidatures.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.recrutements.show', $recrutement) }}" class="btn btn-outline-primary rounded-pill px-4">Fiche</a>
                        <a href="{{ route('rh.candidatures.par-recrutement', $recrutement) }}" class="btn btn-outline-info rounded-pill px-4">Toutes les candidatures</a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $pipelineConfig = [
                'recu' => ['label' => 'Reçues', 'class' => 'primary', 'icon' => 'fa-inbox'],
                'en_etude' => ['label' => 'En étude', 'class' => 'info', 'icon' => 'fa-magnifying-glass'],
                'entretien' => ['label' => 'Entretien', 'class' => 'warning', 'icon' => 'fa-comments'],
                'retenu' => ['label' => 'Retenues', 'class' => 'success', 'icon' => 'fa-check'],
                'rejete' => ['label' => 'Rejetées', 'class' => 'danger', 'icon' => 'fa-xmark'],
            ];
        @endphp

        @foreach($pipelineConfig as $key => $config)
            <div class="col-xl-4">
                <div class="content-card h-100 pipeline-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $config['label'] }}</h5>
                            <p class="text-muted mb-0">{{ $groupes[$key]->count() ?? 0 }} candidat(s)</p>
                        </div>
                        <div class="pipeline-icon bg-{{ $config['class'] }}-subtle text-{{ $config['class'] }}">
                            <i class="fa-solid {{ $config['icon'] }}"></i>
                        </div>
                    </div>

                    <div class="pipeline-list">
                        @forelse($groupes[$key] as $candidature)
                            <a href="{{ route('rh.candidatures.show', $candidature) }}" class="pipeline-item text-decoration-none">
                                <div class="fw-bold">{{ $candidature->nom }} {{ $candidature->prenom }}</div>
                                <div class="text-muted small">{{ $candidature->email ?? 'Email non défini' }}</div>
                            </a>
                        @empty
                            <div class="text-muted small">Aucune candidature dans cette étape.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <style>
        .pipeline-card{transition:all .25s ease}
        .pipeline-icon{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:20px}
        .pipeline-list{display:flex;flex-direction:column;gap:12px}
        .pipeline-item{display:block;padding:14px;border:1px solid #eef2f7;border-radius:16px;color:inherit;transition:all .2s ease}
        .pipeline-item:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(15,23,42,.05)}
    </style>
@endsection