@extends('back.juridique.layouts.app')
@section('title', 'Conformités')
@section('page_title', 'Gestion des conformités')
@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-shield-alt mr-2"></i> Évaluations de conformité</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.conformites.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouvelle évaluation</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Texte légal</th><th>Entreprise</th><th>Statut</th><th>Score</th><th>Date contrôle</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($conformites as $c)
                <tr>
                    <td>{{ $c->legalite->titre }}</td>
                    <td>{{ $c->entreprise->nom ?? '-' }}</td>
                    <td>@include('back.juridique.partials.status-badge', ['status' => $c->statut])</td>
                    <td>{{ $c->score_conformite ? $c->score_conformite . '%' : '-' }}</td>
                    <td>{{ $c->date_controle ? $c->date_controle->format('d/m/Y') : '-' }}</td>
                    <td><a href="{{ route('back.juridique.conformites.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('back.juridique.conformites.edit', $c) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>
                </tr>
                @empty <td><td colspan="6" class="text-center">Aucune évaluation</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $conformites])</div>
</div>
@endsection