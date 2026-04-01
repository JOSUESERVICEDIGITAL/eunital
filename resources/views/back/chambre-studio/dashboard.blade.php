@extends('back.layouts.principal')

@section('title', 'Dashboard studio')
@section('page_title', 'Chambre Studio · Dashboard global')
@section('page_subtitle', 'Vue d’ensemble des productions, réservations, commandes, clients et activités de la chambre studio.')

@section('content')
    @php
        use App\Models\ProductionAudio;
        use App\Models\ProductionVideo;
        use App\Models\CommandeStudio;
        use App\Models\ReservationStudio;
        use App\Models\EvenementStudio;
        use App\Models\CaptationStudio;
        use App\Models\MontageStudio;
        use App\Models\ClientStudio;
        use App\Models\ProjetStudio;
        use App\Models\EquipementStudio;
        use App\Models\HabillageSonore;
        use App\Models\DiffusionStudio;

        $totalAudios = ProductionAudio::count();
        $totalVideos = ProductionVideo::count();
        $totalCommandes = CommandeStudio::count();
        $totalReservations = ReservationStudio::count();
        $totalEvenements = EvenementStudio::count();
        $totalCaptations = CaptationStudio::count();
        $totalMontages = MontageStudio::count();
        $totalClients = ClientStudio::count();
        $totalProjets = ProjetStudio::count();
        $totalEquipements = EquipementStudio::count();
        $totalHabillages = HabillageSonore::count();
        $totalDiffusions = DiffusionStudio::count();

        $commandesEnCours = CommandeStudio::where('statut', 'en_cours')->count();
        $reservationsAujourdhui = ReservationStudio::whereDate('date_debut', now()->toDateString())->count();
        $captationsEnCours = CaptationStudio::where('statut', 'en_cours')->count();
        $montagesEnCours = MontageStudio::where('statut', 'en_cours')->count();
        $videosEnValidation = ProductionVideo::where('statut', 'validation')->count();
        $audiosEnMixage = ProductionAudio::where('statut', 'mixage')->count();

        $dernieresCommandes = CommandeStudio::with('client')->latest()->take(5)->get();
        $dernieresReservations = ReservationStudio::with('client')->latest('date_debut')->take(5)->get();
        $dernieresProductionsVideo = ProductionVideo::with('client')->latest()->take(5)->get();
        $dernieresProductionsAudio = ProductionAudio::with('client')->latest()->take(5)->get();
    @endphp

    {{-- KPI PRINCIPAUX --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="mini-label">Productions audio</div>
                        <div class="stat-number">{{ $totalAudios }}</div>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="fa-solid fa-microphone-lines"></i>
                    </div>
                </div>
                <div class="text-muted small">Sessions audio enregistrées dans le studio.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="mini-label">Productions vidéo</div>
                        <div class="stat-number">{{ $totalVideos }}</div>
                    </div>
                    <div class="stat-icon bg-danger-subtle text-danger">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="text-muted small">Tournages, montages et livrables vidéo du hub.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="mini-label">Commandes studio</div>
                        <div class="stat-number">{{ $totalCommandes }}</div>
                    </div>
                    <div class="stat-icon bg-dark-subtle text-dark">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                </div>
                <div class="text-muted small">Demandes clients liées aux services du studio.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="mini-label">Réservations</div>
                        <div class="stat-number">{{ $totalReservations }}</div>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                </div>
                <div class="text-muted small">Planning des salles, cabines et sessions studio.</div>
            </div>
        </div>
    </div>

    {{-- KPI SECONDAIRES --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">Événements</div>
                <div class="stat-number">{{ $totalEvenements }}</div>
                <div class="text-muted small mt-2">Mariages, concerts et prestations.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">Captations</div>
                <div class="stat-number">{{ $totalCaptations }}</div>
                <div class="text-muted small mt-2">Captations planifiées ou terminées.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">Montages</div>
                <div class="stat-number">{{ $totalMontages }}</div>
                <div class="text-muted small mt-2">Post-productions vidéo en cours.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">Clients</div>
                <div class="stat-number">{{ $totalClients }}</div>
                <div class="text-muted small mt-2">Base clients du studio.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">Projets</div>
                <div class="stat-number">{{ $totalProjets }}</div>
                <div class="text-muted small mt-2">Albums, campagnes et productions.</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">Équipements</div>
                <div class="stat-number">{{ $totalEquipements }}</div>
                <div class="text-muted small mt-2">Matériel disponible et suivi technique.</div>
            </div>
        </div>
    </div>

    {{-- ETAT RAPIDE --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <div class="mini-label">État opérationnel</div>
                        <h5 class="mb-0">Indicateurs rapides du studio</h5>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="quick-stat-box">
                            <div class="quick-stat-title">Commandes en cours</div>
                            <div class="quick-stat-value">{{ $commandesEnCours }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="quick-stat-box">
                            <div class="quick-stat-title">Réservations aujourd’hui</div>
                            <div class="quick-stat-value">{{ $reservationsAujourdhui }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="quick-stat-box">
                            <div class="quick-stat-title">Captations en cours</div>
                            <div class="quick-stat-value">{{ $captationsEnCours }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="quick-stat-box">
                            <div class="quick-stat-title">Montages en cours</div>
                            <div class="quick-stat-value">{{ $montagesEnCours }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="quick-stat-box">
                            <div class="quick-stat-title">Vidéos en validation</div>
                            <div class="quick-stat-value">{{ $videosEnValidation }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="quick-stat-box">
                            <div class="quick-stat-title">Audios en mixage</div>
                            <div class="quick-stat-value">{{ $audiosEnMixage }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <div class="mini-label">Accès rapides</div>
                <h5 class="mb-3">Modules studio</h5>

                <div class="d-grid gap-2">
                    <a href="{{ route('back.chambre-studio.productions-audio.toutes') }}" class="btn btn-light rounded-pill text-start">
                        <i class="fa-solid fa-microphone-lines me-2"></i> Productions audio
                    </a>

                    <a href="{{ route('back.chambre-studio.productions-video.toutes') }}" class="btn btn-light rounded-pill text-start">
                        <i class="fa-solid fa-video me-2"></i> Productions vidéo
                    </a>

                    <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="btn btn-light rounded-pill text-start">
                        <i class="fa-solid fa-file-signature me-2"></i> Commandes
                    </a>

                    <a href="{{ route('back.chambre-studio.reservations.toutes') }}" class="btn btn-light rounded-pill text-start">
                        <i class="fa-solid fa-calendar-check me-2"></i> Réservations
                    </a>

                    <a href="{{ route('back.chambre-studio.clients.tous') }}" class="btn btn-light rounded-pill text-start">
                        <i class="fa-solid fa-users me-2"></i> Clients
                    </a>

                    <a href="{{ route('back.chambre-studio.projets.tous') }}" class="btn btn-light rounded-pill text-start">
                        <i class="fa-solid fa-folder-open me-2"></i> Projets studio
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- BLOCS TABLEAUX --}}
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="mini-label">Dernières commandes</div>
                        <h5 class="mb-0">Commandes récentes</h5>
                    </div>
                    <a href="{{ route('back.chambre-studio.commandes.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">
                        <thead class="table-head-custom">
                            <tr>
                                <th>Titre</th>
                                <th>Client</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dernieresCommandes as $commande)
                                <tr>
                                    <td>{{ $commande->titre }}</td>
                                    <td>{{ $commande->client->nom ?? '—' }}</td>
                                    <td>
                                        <span class="badge rounded-pill
                                            {{ $commande->statut === 'livre' ? 'bg-success' : ($commande->statut === 'en_cours' ? 'bg-primary' : 'bg-warning text-dark') }}">
                                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Aucune commande récente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="mini-label">Dernières réservations</div>
                        <h5 class="mb-0">Planning récent</h5>
                    </div>
                    <a href="{{ route('back.chambre-studio.reservations.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">
                        <thead class="table-head-custom">
                            <tr>
                                <th>Client</th>
                                <th>Salle</th>
                                <th>Début</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dernieresReservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->client->nom ?? '—' }}</td>
                                    <td>{{ $reservation->salle ?? '—' }}</td>
                                    <td>{{ $reservation->date_debut ? \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y H:i') : '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Aucune réservation récente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="mini-label">Dernières vidéos</div>
                        <h5 class="mb-0">Productions vidéo récentes</h5>
                    </div>
                    <a href="{{ route('back.chambre-studio.productions-video.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">
                        <thead class="table-head-custom">
                            <tr>
                                <th>Titre</th>
                                <th>Client</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dernieresProductionsVideo as $video)
                                <tr>
                                    <td>{{ $video->titre }}</td>
                                    <td>{{ $video->client->nom ?? '—' }}</td>
                                    <td>{{ ucfirst($video->statut) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Aucune production vidéo récente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="mini-label">Derniers audios</div>
                        <h5 class="mb-0">Productions audio récentes</h5>
                    </div>
                    <a href="{{ route('back.chambre-studio.productions-audio.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">
                        <thead class="table-head-custom">
                            <tr>
                                <th>Titre</th>
                                <th>Client</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dernieresProductionsAudio as $audio)
                                <tr>
                                    <td>{{ $audio->titre }}</td>
                                    <td>{{ $audio->client->nom ?? '—' }}</td>
                                    <td>{{ ucfirst($audio->statut) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Aucune production audio récente.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .quick-stat-box{
            padding: 18px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .quick-stat-title{
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .quick-stat-value{
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1;
        }
    </style>
@endsection
