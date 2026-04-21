@extends('back.layouts.principal')

@section('title', 'Historique de l’évaluation')
@section('page_title', 'Historique de l’évaluation')
@section('page_subtitle', 'Chronologie RH de l’évaluation : création, évolution de statut et date métier.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $evaluation->titre }}</h4>
                        <p class="text-muted mb-0">
                            {{ optional($evaluation->membreEquipe)->nom }} {{ optional($evaluation->membreEquipe)->prenom }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.evaluations.show', $evaluation) }}" class="btn btn-outline-primary rounded-pill px-4">
                            Fiche
                        </a>
                        <a href="{{ route('rh.evaluations.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </div>

                @forelse($timeline as $item)
                    <div class="timeline-item">
                        <div class="timeline-dot
                            @if($item['type'] === 'creation') bg-primary
                            @elseif($item['type'] === 'statut') bg-warning
                            @else bg-info
                            @endif"></div>

                        <div class="timeline-card">
                            <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                <div>
                                    <div class="fw-bold">{{ $item['titre'] }}</div>
                                    <div class="text-muted small">{{ $item['description'] }}</div>
                                </div>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ \Carbon\Carbon::parse($item['date'])->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-clock-rotate-left empty-state-icon"></i>
                        <h5 class="mt-3">Aucun historique</h5>
                        <p class="text-muted">La chronologie de cette évaluation apparaîtra ici.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <style>
        .timeline-item{display:flex;gap:16px;position:relative;padding-bottom:18px}
        .timeline-item:not(:last-child)::after{
            content:'';
            position:absolute;
            left:9px;
            top:24px;
            width:2px;
            height:calc(100% - 8px);
            background:#e5e7eb;
        }
        .timeline-dot{
            width:20px;
            height:20px;
            border-radius:50%;
            flex-shrink:0;
            margin-top:12px;
        }
        .timeline-card{
            flex:1;
            border:1px solid #eef2f7;
            border-radius:18px;
            padding:16px;
            background:#fff;
        }
        .empty-state{text-align:center;padding:30px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection