@extends('back.layouts.principal')

@section('title', 'Contrats du personnel')
@section('page_title', 'Contrats du personnel')
@section('page_subtitle', 'Références contractuelles liées au collaborateur et passerelle avec le module juridique.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            {{ optional($membre)->nom }} {{ optional($membre)->prenom }}
                        </h4>
                        <p class="text-muted mb-0">Contrats et engagements rattachés au dossier.</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('rh.dossiers-personnel.show', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">Fiche</a>
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
                    </div>
                </div>

                @if($contrats->count())
                    <div class="table-responsive">
                        <table class="table align-middle custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Contrat</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contrats as $contrat)
                                    <tr>
                                        <td>{{ $contrat->id ?? '—' }}</td>
                                        <td>{{ $contrat->titre ?? 'Contrat' }}</td>
                                        <td>{{ $contrat->type ?? '—' }}</td>
                                        <td>{{ $contrat->created_at?->format('d/m/Y') ?? '—' }}</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light rounded-pill px-3">Ouvrir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-file-signature empty-state-icon"></i>
                        <h5 class="mt-3">Aucun contrat lié</h5>
                        <p class="text-muted">Tu pourras relier ici les contrats issus du module juridique.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .empty-state{text-align:center;padding:30px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection
