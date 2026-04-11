@php
    $statusClasses = [
        'active' => 'success',
        'inactive' => 'secondary',
        'en_attente' => 'warning',
        'valide' => 'success',
        'termine' => 'info',
        'abandonne' => 'danger',
        'present' => 'success',
        'absent' => 'danger',
        'retard' => 'warning',
        'publie' => 'success',
        'brouillon' => 'secondary',
        'debutant' => 'info',
        'intermediaire' => 'primary',
        'avance' => 'warning',
        'expert' => 'danger',
    ];

    $statusLabels = [
        'active' => 'Actif',
        'inactive' => 'Inactif',
        'en_attente' => 'En attente',
        'valide' => 'Validé',
        'termine' => 'Terminé',
        'abandonne' => 'Abandonné',
        'present' => 'Présent',
        'absent' => 'Absent',
        'retard' => 'En retard',
        'publie' => 'Publié',
        'brouillon' => 'Brouillon',
        'debutant' => 'Débutant',
        'intermediaire' => 'Intermédiaire',
        'avance' => 'Avancé',
        'expert' => 'Expert',
    ];

    $class = $statusClasses[$status] ?? 'secondary';
    $label = $statusLabels[$status] ?? ucfirst($status);
@endphp

<span class="badge badge-{{ $class }}">
    {{ $label }}
</span>
