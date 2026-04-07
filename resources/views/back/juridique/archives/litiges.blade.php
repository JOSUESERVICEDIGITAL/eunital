@extends('back.juridique.layouts.app')
@section('title', 'Litiges archivés')
@section('page_title', 'Archives de litiges')
@section('juridique-content')
<div class="card"><div class="card-header">Litiges archivés</div><div class="card-body p-0"><table class="table"><thead><tr><th>Référence</th><th>Titre</th><th>Date archivage</th><th>Actions</th></tr></thead><tbody>@forelse($archives as $a)</td><td><code>{{ $a->reference }}</code></td><td>{{ $a->titre }}</td><td>{{ $a->date_archivage->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.archives.show', $a) }}" class="btn btn-sm btn-info">Voir</a></td></tr>@empty <td><td colspan="4">Aucun litige archivé</td></tr>@endforelse</tbody></table></div></div>
@endsection