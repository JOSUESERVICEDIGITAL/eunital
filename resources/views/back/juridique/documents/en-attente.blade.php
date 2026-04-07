@extends('back.juridique.layouts.app')
@section('title', 'Documents en attente')
@section('page_title', 'Documents en attente de validation')
@section('page_subtitle', 'Documents nécessitant une validation')

@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-clock text-warning"></i> En attente de validation</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>#</th><th>Numéro</th><th>Titre</th><th>Type</th><th>Date création</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr><td>{{ $doc->id }}</td><td><code>{{ $doc->numero_unique }}</code></td><td><strong>{{ $doc->titre }}</strong></td><td>{{ $doc->typeDocument->nom ?? '-' }}</td><td>{{ $doc->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('back.juridique.documents.show', $doc) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <button onclick="validerDocument({{ $doc->id }})" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Valider</button></td></tr>
                    @empty <tr><td colspan="6" class="text-center py-4">Aucun document en attente</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $documents])</div>
</div>
@endsection

@push('juridique-scripts')
<script>
function validerDocument(id) {
    Swal.fire({ title: 'Validation', text: 'Valider ce document ?', icon: 'question', showCancelButton: true, confirmButtonColor: '#28a745', confirmButtonText: 'Valider' }).then((result) => {
        if (result.isConfirmed) { $.ajax({ url: '/back/juridique/documents/' + id + '/valider', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' }, success: function(r) { if(r.success) location.reload(); } }); }
    });
}
</script>
@endpush
