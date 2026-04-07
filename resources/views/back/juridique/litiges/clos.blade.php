@extends('back.juridique.layouts.app')
@section('title', 'Litiges clos')
@section('page_title', 'Litiges terminés')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Litiges clos</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Référence</th><th>Titre</th><th>Date clôture</th><th>Coût total</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($litiges as $l)
                <tr><td><code>{{ $l->reference }}</code></td><td>{{ $l->titre }}</td><td>{{ $l->date_cloture->format('d/m/Y') }}</td><td>{{ number_format($l->cout_total ?? 0, 2) }} €</td><td><a href="{{ route('back.juridique.litiges.show', $l) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                @empty <td><td colspan="5" class="text-center">Aucun litige clos</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection