@extends('back.juridique.layouts.app')
@section('title', 'Signatures effectuées')
@section('page_title', 'Signatures effectuées')
@section('page_subtitle', 'Historique des signatures')

@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Signatures complétées</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Document</th><th>Signataire</th><th>Date signature</th><th>IP</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($signatures as $sig)
                    <tr>
                        <td><a href="{{ route('back.juridique.documents.show', $sig->document) }}">{{ $sig->document->titre }}</a></td>
                        <td>{{ $sig->user->name }}</td>
                        <td>{{ $sig->date_signature->format('d/m/Y H:i') }}</td>
                        <td><code>{{ $sig->adresse_ip }}</code></td>
                        <td><a href="{{ route('back.juridique.signatures.show', $sig) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    @empty <td><td colspan="5" class="text-center">Aucune signature effectuée</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection