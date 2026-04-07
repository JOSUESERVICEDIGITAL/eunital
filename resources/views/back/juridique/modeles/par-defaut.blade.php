@extends('back.juridique.layouts.app')
@section('title', 'Modèles par défaut')
@section('page_title', 'Modèles par défaut')
@section('page_subtitle', 'Modèles pré-sélectionnés par type de document')

@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-star text-warning"></i> Modèles par défaut</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Type de document</th><th>Modèle par défaut</th><th>Version</th><th>Actions</th></tr></thead>
                <tbody>
                    @php $grouped = $modeles->groupBy('type_document_id'); @endphp
                    @foreach($grouped as $typeId => $items)
                    @php $type = $items->first()->typeDocument; @endphp
                    <tr><td>{{ $type->nom ?? '-' }}</td>
                    <td><strong>{{ $items->where('is_default', true)->first()->titre ?? 'Aucun' }}</strong></td>
                    <td>{{ $items->where('is_default', true)->first()->version ?? '-' }}</td>
                    <td><a href="{{ route('back.juridique.modeles.show', $items->where('is_default', true)->first()->id ?? 0) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
