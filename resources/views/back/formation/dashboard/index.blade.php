@extends('back.formation.layouts.app')

@section('title', 'Dashboard Formation')
@section('page_title', 'Tableau de bord')
@section('page_subtitle', 'Vue d\'ensemble intelligente de l\'activité formation')

@section('page_actions')
    <div class="btn-group">
        <a href="{{ route('back.formation.cours.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nouveau cours
        </a>
        <a href="{{ route('back.formation.modules.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-layer-group"></i> Module
        </a>
        <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-user-plus"></i> Inscription
        </a>
    </div>
@endsection

@section('formation-content')

    {{-- ALERTS --}}
    @include('back.formation.partials.alerts')

    {{-- STATS AVEC ACTIONS --}}
    <div class="row">
        @php
            $cards = [
                [
                    'title' => 'Modules',
                    'value' => $stats['total_modules'] ?? 0,
                    'icon' => 'fa-folder',
                    'color' => 'info',
                    'route' => route('back.formation.modules.index'),
                ],
                [
                    'title' => 'Cours',
                    'value' => $stats['total_cours'] ?? 0,
                    'icon' => 'fa-book',
                    'color' => 'success',
                    'route' => route('back.formation.cours.index'),
                ],
                [
                    'title' => 'Inscriptions',
                    'value' => $stats['total_inscriptions_validees'] ?? 0,
                    'icon' => 'fa-users',
                    'color' => 'warning',
                    'route' => route('back.formation.inscriptions.index'),
                ],
                [
                    'title' => 'À corriger',
                    'value' => $stats['total_soumissions_non_corrigees'] ?? 0,
                    'icon' => 'fa-tasks',
                    'color' => 'danger',
                    'route' => route('back.formation.soumissions.a-corriger'),
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-lg-3 col-6">
                <div class="small-box bg-{{ $card['color'] }} shadow-sm">
                    <div class="inner">
                        <h3>{{ $card['value'] }}</h3>
                        <p>{{ $card['title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas {{ $card['icon'] }}"></i>
                    </div>
                    <a href="{{ $card['route'] }}" class="small-box-footer">
                        Accéder <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ACTION RAPIDE --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex flex-wrap gap-2">
            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#quickCreateModal">
                <i class="fas fa-bolt"></i> Action rapide
            </button>

            <a href="{{ route('back.formation.presences.create') }}" class="btn btn-outline-success btn-sm">
                <i class="fas fa-user-check"></i> Présence
            </a>

            <a href="{{ route('back.formation.acces-salles.index') }}" class="btn btn-outline-dark btn-sm">
                <i class="fas fa-door-open"></i> Accès salle
            </a>
        </div>
    </div>

    {{-- GRAPHIQUES --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        📈 Évolution des inscriptions
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="inscriptionsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        🎯 Niveaux
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="coursChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- DERNIERS COURS + ACTIONS --}}
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Derniers cours</h3>

            <a href="{{ route('back.formation.cours.index') }}" class="btn btn-sm btn-light">
                Voir tout
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tbody>
                    @foreach ($derniersCours ?? [] as $cour)
                        <tr>
                            <td>
                                <strong>{{ $cour->titre }}</strong><br>
                                <small class="text-muted">{{ $cour->module->titre ?? '' }}</small>
                            </td>

                            <td>
                                @include('back.formation.partials.status-badge', [
                                    'status' => $cour->niveau_difficulte,
                                ])
                            </td>

                            <td class="text-right">
                                @include('back.formation.partials.table-actions', [
                                    'showRoute' => route('back.formation.cours.show', $cour),
                                    'editRoute' => route('back.formation.cours.edit', $cour),
                                    'deleteRoute' => route('back.formation.cours.destroy', $cour),
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL ACTION RAPIDE --}}
    <div class="modal fade" id="quickCreateModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Action rapide</h5>
                </div>
                <div class="modal-body text-center">

                    <a href="{{ route('back.formation.cours.create') }}" class="btn btn-primary m-2">
                        ➕ Cours
                    </a>

                    <a href="{{ route('back.formation.modules.create') }}" class="btn btn-success m-2">
                        📦 Module
                    </a>

                    <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-warning m-2">
                        👨‍🎓 Inscription
                    </a>

                </div>
            </div>
        </div>
    </div>

@endsection
