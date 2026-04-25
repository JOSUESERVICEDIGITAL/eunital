@extends('back.layouts.principal')

@section('title', 'Sessions comité')
@section('page_title', 'Sessions du comité')
@section('page_subtitle', $comite->nom)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Sessions</h4>
            <p>Réunions de gouvernance, validation et arbitrage.</p>
        </div>
        <a href="{{ route('back.innovations.comites.show', $comite) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Session</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Participants</th>
                    <th>Décisions</th>
                    <th>Références</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comite->sessions as $session)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $session->titre }}</div>
                            <small class="text-muted">{{ Str::limit($session->ordre_du_jour, 70) }}</small>
                        </td>
                        <td>{{ optional($session->date_session)->format('d/m/Y H:i') ?? '—' }}</td>
                        <td>{{ $session->lieu ?? '—' }}</td>
                        <td>{{ $session->participants->count() }}</td>
                        <td>{{ $session->decisions->count() }}</td>
                        <td>{{ $session->references->count() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted">Aucune session.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('back.innovations.comites._styles')
@endsection
