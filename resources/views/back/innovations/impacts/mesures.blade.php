@extends('back.layouts.principal')

@section('title', 'Mesures impact')
@section('page_title', 'Mesures d’impact')
@section('page_subtitle', optional($impact->innovation)->titre ?? 'Innovation')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Mesures</h4>
            <p>Indicateurs mesurés pour cet impact.</p>
        </div>
        <a href="{{ route('back.innovations.impacts.show', $impact) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Indicateur</th>
                    <th>Unité</th>
                    <th>Valeur</th>
                    <th>Date mesure</th>
                </tr>
            </thead>
            <tbody>
                @forelse($impact->mesures as $mesure)
                    <tr>
                        <td class="fw-bold">{{ $mesure->indicateur }}</td>
                        <td>{{ $mesure->unite ?? '—' }}</td>
                        <td>{{ $mesure->valeur ?? '—' }}</td>
                        <td>{{ optional($mesure->date_mesure)->format('d/m/Y') ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Aucune mesure.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('back.innovations.impacts._styles')
@endsection
