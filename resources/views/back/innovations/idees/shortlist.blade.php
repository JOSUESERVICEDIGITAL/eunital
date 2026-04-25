@extends('back.layouts.principal')

@section('title', 'Shortlist idées')
@section('page_title', 'Shortlist des idées')
@section('page_subtitle', 'Idées prioritaires à analyser ou transformer.')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Shortlist innovation</h4>
            <p>Idées classées par intérêt et votes.</p>
        </div>
        <a href="{{ route('back.innovations.idees.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Idée</th>
                    <th>Statut</th>
                    <th>Maturité</th>
                    <th>Votes</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($idees as $idee)
                    <tr>
                        <td class="fw-bold">{{ $idee->titre }}</td>
                        <td>{{ $idee->statut }}</td>
                        <td>{{ $idee->niveau_maturite }}</td>
                        <td>{{ $idee->votes_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.innovations.idees.show', $idee) }}" class="btn btn-sm btn-light rounded-pill">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Aucune idée en shortlist.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $idees->links() }}
</div>

@include('back.innovations.idees._styles')
@endsection
