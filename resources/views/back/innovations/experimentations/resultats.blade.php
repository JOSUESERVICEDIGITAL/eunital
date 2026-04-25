@extends('back.layouts.principal')

@section('title', 'Résultats expérimentation')
@section('page_title', 'Résultats')
@section('page_subtitle', $experimentation->titre)

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Résultats mesurés</h4>
            <p>Comparaison entre valeurs de référence et valeurs obtenues.</p>
        </div>
        <a href="{{ route('back.innovations.experimentations.show', $experimentation) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle hub-table">
            <thead>
                <tr>
                    <th>Indicateur</th>
                    <th>Unité</th>
                    <th>Référence</th>
                    <th>Obtenue</th>
                    <th>Observation</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experimentation->resultats as $resultat)
                    <tr>
                        <td class="fw-bold">{{ $resultat->indicateur }}</td>
                        <td>{{ $resultat->unite ?? '—' }}</td>
                        <td>{{ $resultat->valeur_reference ?? '—' }}</td>
                        <td>{{ $resultat->valeur_obtenue ?? '—' }}</td>
                        <td>{{ $resultat->observation ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Aucun résultat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('back.innovations.experimentations._styles')
@endsection
