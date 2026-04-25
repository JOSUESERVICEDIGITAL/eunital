@extends('back.layouts.principal')

@section('title','Documents innovation')
@section('page_title','Documents')
@section('page_subtitle','Gestion documentaire des innovations')

@section('content')
<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold">Documents</h4>
            <p class="text-muted mb-0">Tous les fichiers liés aux innovations</p>
        </div>

        <a href="{{ route('back.innovations.documents.create') }}" class="btn btn-warning rounded-pill px-4">
            <i class="fa fa-plus me-2"></i>Ajouter
        </a>
    </div>

    <div class="table-responsive">
        <table class="table hub-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Innovation</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($documents as $doc)
                <tr>
                    <td class="fw-bold">{{ $doc->nom }}</td>
                    <td>{{ $doc->type }}</td>
                    <td>{{ optional($doc->innovation)->titre }}</td>
                    <td>{{ optional($doc->created_at)->format('d/m/Y') }}</td>

                    <td class="text-end">
                        <a href="{{ route('back.innovations.documents.show',$doc) }}" class="btn btn-light btn-sm rounded-pill">Voir</a>
                        <a href="{{ route('back.innovations.documents.edit',$doc) }}" class="btn btn-warning btn-sm rounded-pill">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">Aucun document</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $documents->links() }}

</div>

@include('back.innovations.documents._styles')
@endsection
