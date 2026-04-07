@extends('back.juridique.layouts.app')
@section('title', 'Contrats expirés')
@section('page_title', 'Contrats arrivés à expiration')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-exclamation-triangle text-danger"></i> Contrats expirés</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Référence</th><th>Titre</th><th>Date expiration</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($contrats as $c)
                    <tr><td><code>{{ $c->reference }}</code></td><td>{{ $c->document->titre }}</td><td class="text-danger">{{ $c->date_fin->format('d/m/Y') }}</td>
                    <td><a href="{{ route('back.juridique.contrats.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                    @empty <tr><td colspan="4" class="text-center">Aucun contrat expiré</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection