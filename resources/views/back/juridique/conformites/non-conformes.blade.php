@extends('back.juridique.layouts.app')
@section('title', 'Conformités - Non conformes')
@section('page_title', 'Non-conformités')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-exclamation-triangle text-danger"></i> Non-conformités</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Texte légal</th><th>Score</th><th>Actions correctives</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($conformites as $c)
                <tr><td>{{ $c->legalite->titre }}</td><td class="text-danger">{{ $c->score_conformite }}%</td><td>{{ count($c->actions_correctives ?? []) }} action(s)</td><td><a href="{{ route('back.juridique.conformites.plan-action', $c) }}" class="btn btn-sm btn-warning">Plan d'action</a></td></tr>
                @empty <td><td colspan="4" class="text-center">Aucune non-conformité</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection