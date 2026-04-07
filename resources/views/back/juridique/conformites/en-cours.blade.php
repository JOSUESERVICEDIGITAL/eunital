@extends('back.juridique.layouts.app')
@section('title', 'Conformités - En cours')
@section('page_title', 'Évaluations en cours')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-clock text-warning"></i> Évaluations en cours</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Texte légal</th><th>Date limite</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($conformites as $c)
                <tr><td>{{ $c->legalite->titre }}</td><td>{{ $c->date_prochaine_evaluation ? $c->date_prochaine_evaluation->format('d/m/Y') : 'Non définie' }}</td><td>{{ $c->statut_label }}</td><td><a href="{{ route('back.juridique.conformites.show', $c) }}" class="btn btn-sm btn-info">Continuer</a></td></tr>
                @empty <tr><td colspan="4" class="text-center">Aucune évaluation en cours</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection