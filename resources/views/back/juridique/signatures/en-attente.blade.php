@extends('back.juridique.layouts.app')
@section('title', 'Signatures en attente')
@section('page_title', 'Signatures en attente')
@section('page_subtitle', 'Documents à signer')

@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-clock text-warning"></i> Signatures requises</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Document</th><th>Type</th><th>Demandé le</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($signatures as $sig)
                    <tr>
                        <td><a href="{{ route('back.juridique.documents.show', $sig->document) }}">{{ $sig->document->titre }}</a></td>
                        <td>{{ $sig->type_signataire_label }}</td>
                        <td>{{ $sig->created_at->format('d/m/Y H:i') }}</td>
                        <td><a href="{{ route('back.juridique.signatures.show', $sig) }}" class="btn btn-sm btn-success"><i class="fas fa-pen"></i> Signer</a></td>
                    </tr>
                    @empty <td><td colspan="4" class="text-center">Aucune signature en attente</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection