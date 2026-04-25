@extends('back.layouts.principal')

@section('title', 'Planning comité')
@section('page_title', 'Planning du comité')
@section('page_subtitle', $comite->nom)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Planning des sessions</h4>
            <p>Chronologie des réunions planifiées et passées.</p>
        </div>
        <a href="{{ route('back.innovations.comites.show', $comite) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="timeline-list">
        @forelse($comite->sessions->sortBy('date_session') as $session)
            <div class="timeline-item">
                <div class="timeline-dot bg-warning"></div>
                <div class="timeline-card">
                    <strong>{{ $session->titre }}</strong>
                    <p>{{ $session->ordre_du_jour ?? 'Aucun ordre du jour.' }}</p>
                    <small>
                        {{ optional($session->date_session)->format('d/m/Y H:i') ?? 'Date non définie' }}
                        @if($session->lieu)
                            • {{ $session->lieu }}
                        @endif
                    </small>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">Aucune session planifiée.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.comites._styles')
@endsection
