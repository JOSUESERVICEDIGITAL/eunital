@extends('back.juridique.layouts.app')
@section('title', 'Contrats expirant')
@section('page_title', 'Contrats arrivant à expiration')
@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-clock text-warning"></i> Contrats expirant dans les 30 jours</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Référence</th><th>Titre</th><th>Date expiration</th><th>Jours restants</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($contrats as $c)
                    <tr>
                        <td><code>{{ $c->reference }}</code></td>
                        <td>{{ $c->document->titre }}</td>
                        <td class="text-danger">{{ $c->date_fin->format('d/m/Y') }}</td>
                        <td>{{ now()->diffInDays($c->date_fin, false) }} jours</td>
                        <td><a href="{{ route('back.juridique.contrats.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <button onclick="renouvelerContrat({{ $c->id }})" class="btn btn-sm btn-success"><i class="fas fa-sync-alt"></i> Renouveler</button></td>
                    </tr>
                    @empty <tr><td colspan="5" class="text-center">Aucun contrat expirant</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('juridique-scripts')
<script>
function renouvelerContrat(id) {
    Swal.fire({ title: 'Renouveler le contrat', text: 'Confirmez-vous le renouvellement ?', icon: 'question', showCancelButton: true, confirmButtonColor: '#28a745', confirmButtonText: 'Renouveler' }).then((result) => {
        if (result.isConfirmed) { $.ajax({ url: '/back/juridique/contrats/' + id + '/renouveler', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' }, success: function(r) { if(r.success) location.reload(); } }); }
    });
}
</script>
@endpush