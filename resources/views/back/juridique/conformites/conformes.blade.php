@extends('back.juridique.layouts.app')
@section('title', 'Conformités - Conformes')
@section('page_title', 'Évaluations conformes')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Conformités OK</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Texte légal</th><th>Score</th><th>Date contrôle</th><th>Prochaine évaluation</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($conformites as $c)
                <tr><td>{{ $c->legalite->titre }}</td><td class="text-success">{{ $c->score_conformite }}%</td><td>{{ $c->date_controle->format('d/m/Y') }}</td><td>{{ $c->date_prochaine_evaluation ? $c->date_prochaine_evaluation->format('d/m/Y') : '-' }}</td><td><a href="{{ route('back.juridique.conformites.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                @empty <td><td colspan="5" class="text-center">Aucune conformité</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection