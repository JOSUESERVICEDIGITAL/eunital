@extends('back.layouts.principal')

@section('title', 'Créer un utilisateur')
@section('page_title', 'Nouvel utilisateur')
@section('page_subtitle', 'Ajout d’un nouveau compte dans l’écosystème du hub.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Formulaire de création</h4>
                        <p class="text-muted mb-0">Renseigne les informations du nouvel utilisateur.</p>
                    </div>
                    <span class="badge rounded-pill text-bg-info px-3 py-2">Nouvelle entrée</span>
                </div>

                <form method="POST" action="{{ route('back.utilisateurs.enregistrer') }}" enctype="multipart/form-data">
                    @csrf

                    @include('back.utilisateurs.utilisateurs._formulaire', [
                        'utilisateur' => null,
                        'roles' => $roles
                    ])

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                        </button>

                        <a href="{{ route('back.utilisateurs.tous') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-3">Bonnes pratiques</h5>
                <div class="vstack gap-3">
                    <div class="advice-box">
                        <strong>Rôle cohérent</strong>
                        <p class="mb-0 text-muted small">Attribue dès le départ les rôles adaptés au poste réel.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Compte sécurisé</strong>
                        <p class="mb-0 text-muted small">Utilise un mot de passe fort et un e-mail valide.</p>
                    </div>
                    <div class="advice-box">
                        <strong>Activation maîtrisée</strong>
                        <p class="mb-0 text-muted small">N’active le compte que si l’utilisateur peut accéder au hub immédiatement.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .advice-box{padding:16px;border:1px solid #e5e7eb;border-radius:16px;background:#f8fafc}
        .existing-image-box{padding:16px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .existing-image-box img{max-width:100%;height:220px;object-fit:cover;border-radius:16px}
    </style>
@endsection
