@extends('back.juridique.layouts.app')
@section('title', 'Conseils juridiques')
@section('page_title', 'Bibliothèque de conseils')
@section('page_subtitle', 'Articles et conseils juridiques')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-lightbulb mr-2"></i> Conseils juridiques</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.conseils.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouveau conseil</a></div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Titre</th><th>Catégorie</th><th>Vues</th><th>Statut</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($conseils as $c)
                <tr>
                    <td><strong>{{ $c->titre }}</strong></td>
                    <td><span class="badge badge-info">{{ $c->categorie_label }}</span></td>
                    <td>{{ $c->vues }} vues</td>
                    <td>@include('back.juridique.partials.status-badge', ['status' => $c->is_published ? 'actif' : 'inactif'])</td>
                    <td>{{ $c->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('back.juridique.conseils.show', $c) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('back.juridique.conseils.edit', $c) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        @if(!$c->is_published)<button onclick="publier({{ $c->id }})" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>@endif
                        <button onclick="supprimer({{ $c->id }})" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                </tr>
                @empty <td><td colspan="6" class="text-center">Aucun conseil</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $conseils])</div>
</div>
@endsection

@push('juridique-scripts')
<script>
function publier(id) { $.ajax({ url: '/back/juridique/conseils/' + id + '/publier', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' }, success: function(r) { if(r.success) location.reload(); } }); }
function supprimer(id) { Swal.fire({ title: 'Supprimer', text: 'Confirmez-vous ?', icon: 'warning', showCancelButton: true }).then((r) => { if(r.isConfirmed) $.ajax({ url: '/back/juridique/conseils/' + id, method: 'DELETE', data: { _token: '{{ csrf_token() }}' }, success: function() { location.reload(); } }); }); }
</script>
@endpush