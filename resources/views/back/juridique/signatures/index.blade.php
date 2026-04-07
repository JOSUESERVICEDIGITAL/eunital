@extends('back.juridique.layouts.app')

@section('title', 'Signatures')
@section('page_title', 'Gestion des signatures')
@section('page_subtitle', 'Suivi des signatures électroniques')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-pen mr-2"></i> Signatures</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.signatures.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouvelle signature</a></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead><tr><th>#</th><th>Document</th><th>Signataire</th><th>Type</th><th>Statut</th><th>Date signature</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($signatures as $sig)
                    <tr>
                        <td>{{ $sig->id }}</td>
                        <td><a href="{{ route('back.juridique.documents.show', $sig->document) }}">{{ $sig->document->titre }}</a></td>
                        <td>{{ $sig->user->name }}<br><small>{{ $sig->user->email }}</small></td>
                        <td><span class="badge badge-info">{{ $sig->type_signataire_label }}</span></td>
                        <td>@include('back.juridique.partials.status-badge', ['status' => $sig->statut])</td>
                        <td>{{ $sig->date_signature ? $sig->date_signature->format('d/m/Y H:i') : '-' }}</td>
                        <td><div class="btn-group"><a href="{{ route('back.juridique.signatures.show', $sig) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a><a href="{{ route('back.juridique.signatures.edit', $sig) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></div></td>
                    </tr>
                    @empty <tr><td colspan="7" class="text-center py-4">Aucune signature</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $signatures])</div>
</div>
@endsection
