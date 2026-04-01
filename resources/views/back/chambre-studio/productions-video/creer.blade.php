@extends('back.layouts.principal')

@section('content')
<div class="container">

    <div class="video-page-header mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="video-page-icon bg-danger-subtle text-danger">
                <i class="fa-solid fa-clapperboard"></i>
            </div>
            <div>
                <h3 class="mb-1">Nouvelle production vidéo</h3>
                <p class="text-muted mb-0">
                    Créer une nouvelle fiche de tournage, clip, spot, interview, mariage ou captation événementielle.
                </p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('back.chambre-studio.productions-video.enregistrer') }}">
                        @csrf

                        @include('back.chambre-studio.productions-video._form')

                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4">
                                Enregistrer la production
                            </button>

                            <a href="{{ route('back.chambre-studio.productions-video.toutes') }}"
                               class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3">Guide rapide</h5>

                    <div class="helper-block mb-3">
                        <div class="helper-title">Type de contenu</div>
                        <div class="helper-text">
                            Choisis le type exact : clip, spot, interview, événement ou mariage.
                        </div>
                    </div>

                    <div class="helper-block mb-3">
                        <div class="helper-title">Projet & client</div>
                        <div class="helper-text">
                            Associe la production à un client et, si possible, à un projet studio pour garder l’historique propre.
                        </div>
                    </div>

                    <div class="helper-block">
                        <div class="helper-title">Workflow</div>
                        <div class="helper-text">
                            Le statut initial recommandé est <strong>tournage</strong>. Tu pourras ensuite le faire évoluer.
                        </div>
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <a href="{{ route('back.chambre-studio.dashboard') }}"
                           class="btn btn-outline-dark rounded-pill">
                            Dashboard studio
                        </a>

                        <a href="{{ route('back.chambre-studio.montages.tous') }}"
                           class="btn btn-outline-secondary rounded-pill">
                            Voir les montages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .video-page-icon{
        width:58px;
        height:58px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        flex-shrink:0;
    }

    .helper-block{
        background:#f8fafc;
        border:1px solid #e5e7eb;
        border-radius:18px;
        padding:14px;
    }

    .helper-title{
        font-weight:700;
        color:#0f172a;
        margin-bottom:6px;
    }

    .helper-text{
        color:#64748b;
        font-size:14px;
        line-height:1.55;
    }
</style>
@endsection