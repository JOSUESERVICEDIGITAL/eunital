@extends('back.formation.layouts.app')

@section('title', $devoir->titre)
@section('page_title', $devoir->titre)
@section('page_subtitle', 'Centre de pilotage du devoir, des ressources et des soumissions')

@section('formation-content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 font-weight-bold">{{ $devoir->titre }}</h4>
                    <div class="text-muted small">
                        Cours lié :
                        <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="font-weight-bold text-info">
                            {{ $devoir->cour->titre }}
                        </a>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">
                    <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit mr-1"></i> Modifier
                    </a>

                    <a href="{{ route('back.formation.soumissions.a-corriger', ['devoir' => $devoir->id]) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-check-double mr-1"></i> Corriger
                    </a>

                    <a href="{{ route('back.formation.acces-salles.index') }}?cour_id={{ $devoir->cour_id }}" class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-door-open mr-1"></i> Salle liée
                    </a>

                    <a href="{{ route('back.formation.presences.index') }}?cour_id={{ $devoir->cour_id }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-user-check mr-1"></i> Présences
                    </a>

                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#quickActionsModal">
                        <i class="fas fa-bolt mr-1"></i> Actions
                    </button>

                    <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- KPIs --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $stats['total_soumissions'] ?? 0 }}</h3>
                <p>Soumissions</p>
            </div>
            <div class="icon">
                <i class="fas fa-inbox"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ $stats['soumissions_non_corrigees'] ?? 0 }}</h3>
                <p>À corriger</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-double"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ $stats['soumissions_corrigees'] ?? 0 }}</h3>
                <p>Corrigées</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info shadow-sm">
            <div class="inner">
                <h3>{{ round($stats['moyenne'] ?? 0, 1) }}</h3>
                <p>Note moyenne</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- COLONNE GAUCHE --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-info-circle mr-2 text-primary"></i>
                    Informations générales
                </h3>
            </div>

            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Cours</dt>
                    <dd class="col-sm-7">
                        <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="text-info font-weight-bold">
                            {{ $devoir->cour->titre }}
                        </a>
                    </dd>

                    <dt class="col-sm-5">Type</dt>
                    <dd class="col-sm-7">
                        @include('back.formation.partials.status-badge', ['status' => $devoir->type])
                    </dd>

                    <dt class="col-sm-5">Note max</dt>
                    <dd class="col-sm-7">
                        <span class="badge badge-primary">{{ $devoir->note_maximale }}/{{ $devoir->note_maximale }}</span>
                    </dd>

                    <dt class="col-sm-5">Date limite</dt>
                    <dd class="col-sm-7">
                        @if($devoir->date_limite)
                            {{ \Carbon\Carbon::parse($devoir->date_limite)->format('d/m/Y H:i') }}
                            @if($devoir->est_expire)
                                <div class="mt-1">
                                    <span class="badge badge-danger">Expiré</span>
                                </div>
                            @endif
                        @else
                            <span class="text-muted">Aucune limite</span>
                        @endif
                    </dd>

                    <dt class="col-sm-5">Durée limite</dt>
                    <dd class="col-sm-7">
                        @if($devoir->duree_limite)
                            {{ floor($devoir->duree_limite / 60) }}h {{ $devoir->duree_limite % 60 }}min
                        @else
                            <span class="text-muted">Illimitée</span>
                        @endif
                    </dd>

                    <dt class="col-sm-5">Publication</dt>
                    <dd class="col-sm-7">
                        @if($devoir->is_published)
                            <span class="badge badge-success">Publié</span>
                        @else
                            <span class="badge badge-secondary">Brouillon</span>
                        @endif
                    </dd>

                    <dt class="col-sm-5">Taux soumission</dt>
                    <dd class="col-sm-7">
                        <span class="font-weight-bold text-primary">{{ $stats['taux_soumission'] ?? 0 }}%</span>
                    </dd>
                </dl>

                <hr>

                <h6 class="font-weight-bold">Description</h6>
                <p class="text-muted mb-0">
                    {{ $devoir->description ?: 'Aucune description fournie.' }}
                </p>
            </div>

            <div class="card-footer bg-white border-0">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>

                    @if(!$devoir->is_published)
                        <button type="button" class="btn btn-success" onclick="publierDevoir({{ $devoir->id }})">
                            <i class="fas fa-eye"></i> Publier
                        </button>
                    @else
                        <button type="button" class="btn btn-outline-secondary" onclick="depublierDevoir({{ $devoir->id }})">
                            <i class="fas fa-eye-slash"></i> Dépublier
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bloc progression / timeline --}}
        <div class="card mt-3 shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-chart-simple mr-2 text-success"></i>
                    État du devoir
                </h3>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Taux de soumission</span>
                        <strong>{{ $stats['taux_soumission'] ?? 0 }}%</strong>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ $stats['taux_soumission'] ?? 0 }}%"></div>
                    </div>
                </div>

                <div class="timeline timeline-inverse">
                    <div class="time-label mb-3">
                        <span class="bg-primary px-2 py-1 rounded text-white">Cycle du devoir</span>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-pencil-alt bg-info text-white p-2 rounded-circle mr-2"></i>
                        <span>Créé et paramétré</span>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-bullhorn bg-success text-white p-2 rounded-circle mr-2"></i>
                        <span>{{ $devoir->is_published ? 'Publié pour les étudiants' : 'Encore en brouillon' }}</span>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-file-upload bg-warning text-white p-2 rounded-circle mr-2"></i>
                        <span>{{ $stats['total_soumissions'] ?? 0 }} soumission(s) reçue(s)</span>
                    </div>

                    <div>
                        <i class="fas fa-check-double bg-dark text-white p-2 rounded-circle mr-2"></i>
                        <span>{{ $stats['soumissions_non_corrigees'] ?? 0 }} en attente de correction</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- COLONNE DROITE --}}
    <div class="col-lg-8">
        {{-- Ressources --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-paperclip mr-2 text-primary"></i>
                    Ressources jointes
                </h3>

                <div class="btn-group">
                    <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i> Gérer les ressources
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if($devoir->resources && count($devoir->resources) > 0)
                    <div class="list-group list-group-flush">
                        @foreach($devoir->resources as $index => $resource)
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="mb-2 mb-md-0">
                                        <div class="font-weight-bold">
                                            <i class="fas fa-file-alt mr-2 text-primary"></i>
                                            {{ $resource['name'] }}
                                        </div>
                                        <small class="text-muted">
                                            @if(isset($resource['size']))
                                                {{ number_format($resource['size'] / 1024, 2) }} KB
                                            @endif
                                            @if(isset($resource['type']))
                                                - {{ $resource['type'] }}
                                            @endif
                                        </small>
                                    </div>

                                    <div class="btn-group">
                                        <a href="{{ asset('storage/' . $resource['path']) }}" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-eye mr-1"></i> Voir
                                        </a>
                                        <a href="{{ asset('storage/' . $resource['path']) }}" class="btn btn-sm btn-outline-primary" download>
                                            <i class="fas fa-download mr-1"></i> Télécharger
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-paperclip fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-2">Aucune ressource jointe</p>
                        <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus mr-1"></i> Ajouter des ressources
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Bloc communication avec salle / présence / cours --}}
        <div class="card mt-3 shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-network-wired mr-2 text-dark"></i>
                    Navigation liée au devoir
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-6 mb-2">
                        <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-book d-block mb-1"></i>
                            Cours
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-2">
                        <a href="{{ route('back.formation.acces-salles.index') }}?cour_id={{ $devoir->cour_id }}" class="btn btn-outline-dark btn-block">
                            <i class="fas fa-door-open d-block mb-1"></i>
                            Salle
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-2">
                        <a href="{{ route('back.formation.presences.index') }}?cour_id={{ $devoir->cour_id }}" class="btn btn-outline-success btn-block">
                            <i class="fas fa-user-check d-block mb-1"></i>
                            Présences
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-2">
                        <a href="{{ route('back.formation.soumissions.index') }}?devoir={{ $devoir->id }}" class="btn btn-outline-warning btn-block">
                            <i class="fas fa-inbox d-block mb-1"></i>
                            Soumissions
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Soumissions --}}
        <div class="card mt-3 shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-users mr-2 text-primary"></i>
                    Soumissions des étudiants
                </h3>

                <div class="btn-group">
                    <a href="{{ route('back.formation.soumissions.a-corriger', ['devoir' => $devoir->id]) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-check-double mr-1"></i> Corriger ({{ $stats['soumissions_non_corrigees'] }})
                    </a>

                    <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#notifyModal">
                        <i class="fas fa-bell mr-1"></i> Notifier
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                @if($devoir->soumissions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Soumis le</th>
                                    <th>Note</th>
                                    <th>Statut</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devoir->soumissions as $soumission)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle mr-2 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                                                     style="width: 38px; height: 38px; font-size: 14px;">
                                                    {{ strtoupper(substr($soumission->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $soumission->user->name }}</strong><br>
                                                    <small class="text-muted">{{ $soumission->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            {{ $soumission->soumis_le->format('d/m/Y H:i') }}
                                            @if($soumission->est_en_retard)
                                                <div class="mt-1">
                                                    <span class="badge badge-danger">En retard</span>
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            @if($soumission->note !== null)
                                                <span class="badge badge-{{ $soumission->note >= ($devoir->note_maximale * 0.6) ? 'success' : 'warning' }}">
                                                    {{ $soumission->note }}/{{ $devoir->note_maximale }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">En attente</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($soumission->est_corrige)
                                                <span class="badge badge-success">Corrigé</span>
                                            @else
                                                <span class="badge badge-warning">À corriger</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                @if(!$soumission->est_corrige)
                                                    <a href="{{ route('back.formation.soumissions.show', $soumission) }}#correction" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-check-double"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <div class="font-weight-bold">Aucune soumission pour le moment</div>
                        <p class="text-muted mb-0">Les étudiants n’ont pas encore remis ce devoir.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal actions rapides --}}
<div class="modal fade" id="quickActionsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-bolt mr-2"></i> Actions rapides
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">
                <a href="{{ route('back.formation.devoirs.edit', $devoir) }}" class="btn btn-warning m-1">
                    <i class="fas fa-edit mr-1"></i> Modifier
                </a>

                <a href="{{ route('back.formation.soumissions.a-corriger', ['devoir' => $devoir->id]) }}" class="btn btn-success m-1">
                    <i class="fas fa-check-double mr-1"></i> Corriger
                </a>

                <a href="{{ route('back.formation.cours.show', $devoir->cour) }}" class="btn btn-info m-1">
                    <i class="fas fa-book mr-1"></i> Ouvrir le cours
                </a>

                <a href="{{ route('back.formation.acces-salles.index') }}?cour_id={{ $devoir->cour_id }}" class="btn btn-dark m-1">
                    <i class="fas fa-door-open mr-1"></i> Voir la salle
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Modal notifier --}}
<div class="modal fade" id="notifyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="{{ route('back.formation.notifications.create') }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-bell mr-2"></i> Préparer une notification
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Sujet</label>
                        <input type="text" class="form-control" name="titre" value="Rappel / information : {{ $devoir->titre }}">
                    </div>

                    <div class="form-group mb-0">
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="5">Bonjour, ceci concerne le devoir "{{ $devoir->titre }}" du cours "{{ $devoir->cour->titre }}". Merci de vérifier les consignes, la date limite et votre soumission.</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-1"></i> Continuer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function publierDevoir(id) {
        Swal.fire({
            title: 'Publier ce devoir ?',
            text: 'Les étudiants pourront le consulter et le soumettre.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, publier',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#28a745'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/devoirs/' + id + '/publier',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        Swal.fire('Publié !', 'Le devoir a été publié.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'Impossible de publier le devoir.', 'error');
                    }
                });
            }
        });
    }

    function depublierDevoir(id) {
        Swal.fire({
            title: 'Dépublier ce devoir ?',
            text: 'Les étudiants ne pourront plus y accéder.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, dépublier',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/devoirs/' + id + '/depublier',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        Swal.fire('Dépublié', 'Le devoir a été retiré de la publication.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'Impossible de dépublier le devoir.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
