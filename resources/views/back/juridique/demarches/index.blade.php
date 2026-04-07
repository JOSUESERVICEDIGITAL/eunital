@extends('back.juridique.layouts.app')
@section('title', 'Démarches administratives')
@section('page_title', 'Démarches administratives')
@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-building mr-2"></i> Démarches administratives</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.demarches.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouvelle démarche</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Titre</th><th>Catégorie</th><th>Délai estimé</th><th>Coût estimé</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($demarches as $d)
                <tr>
                    <td><strong>{{ $d->titre }}</strong><br><small class="text-muted">{{ $d->slug }}</small></td>
                    <td><span class="badge badge-info">{{ $d->categorie_label }}</span></td>
                    <td>{{ $d->delai_formate }}</td>
                    <td>{{ $d->cout_estime ? number_format($d->cout_estime, 2) . ' €' : '-' }}</td>
                    <td>@include('back.juridique.partials.status-badge', ['status' => $d->is_active ? 'actif' : 'inactif'])</td>
                    <td><a href="{{ route('back.juridique.demarches.show', $d) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('back.juridique.demarches.edit', $d) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <button onclick="toggleActive({{ $d->id }})" class="btn btn-sm btn-{{ $d->is_active ? 'secondary' : 'success' }}"><i class="fas fa-{{ $d->is_active ? 'ban' : 'check' }}"></i></button>
                        <button onclick="supprimer({{ $d->id }})" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                </tr>
                @empty <tr><td colspan="6" class="text-center">Aucune démarche administrative</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $demarches])</div>
</div>
@endsection

@push('juridique-scripts')
<script>
function toggleActive(id) {
    $.ajax({ url: '/back/juridique/demarches/' + id + '/toggle-active', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' }, success: function(r) { if(r.success) location.reload(); } });
}
function supprimer(id) {
    Swal.fire({ title: 'Supprimer', text: 'Confirmez-vous ?', icon: 'warning', showCancelButton: true }).then((r) => {
        if(r.isConfirmed) $.ajax({ url: '/back/juridique/demarches/' + id, method: 'DELETE', data: { _token: '{{ csrf_token() }}' }, success: function() { location.reload(); } });
    });
}
</script>
@endpush