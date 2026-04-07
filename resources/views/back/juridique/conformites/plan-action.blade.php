@extends('back.juridique.layouts.app')
@section('title', 'Plan d\'action')
@section('page_title', 'Plan d\'action correctif')
@section('juridique-content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informations</h3></div>
            <div class="card-body">
                <dl><dt>Texte légal</dt><dd>{{ $conformite->legalite->titre }}</dd>
                <dt>Score actuel</dt><dd class="text-danger">{{ $conformite->score_conformite }}%</dd>
                <dt>Statut</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $conformite->statut])</dd></dl>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Ajouter une action</h3></div>
            <form action="{{ route('back.juridique.conformites.ajouter-action', $conformite) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group"><label>Action</label><textarea name="action" class="form-control" rows="2" required></textarea></div>
                    <div class="form-group"><label>Responsable</label><input type="text" name="responsable" class="form-control"></div>
                    <div class="form-group"><label>Date limite</label><input type="date" name="date_limite" class="form-control"></div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header"><h3 class="card-title">Actions correctives en cours</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Action</th><th>Responsable</th><th>Date limite</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($conformite->actions_correctives ?? [] as $action)
                <tr><td>{{ $action['action'] ?? '' }}</td><td>{{ $action['responsable'] ?? '-' }}</td><td>{{ $action['date_limite'] ?? '-' }}</td><td>{{ $action['statut'] ?? 'En cours' }}</td><td><button class="btn btn-sm btn-success">Terminer</button></td></tr>
                @empty <td><td colspan="5" class="text-center">Aucune action corrective</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection