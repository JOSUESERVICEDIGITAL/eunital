@php
$statusClasses = [
    'brouillon' => 'secondary', 'en_attente' => 'warning', 'signature_attendue' => 'info',
    'signe' => 'primary', 'valide' => 'success', 'expire' => 'danger', 'annule' => 'dark',
    'archive' => 'secondary', 'conforme' => 'success', 'non_conforme' => 'danger',
    'partiellement_conforme' => 'warning', 'en_cours' => 'info', 'actif' => 'success',
    'inactif' => 'secondary', 'ouvert' => 'danger', 'clos' => 'success',
    'cdi' => 'primary', 'cdd' => 'info', 'freelance' => 'warning', 'prestation' => 'success',
    'partenariat' => 'primary', 'confidentialite' => 'secondary', 'licence' => 'info', 'location' => 'warning', 'vente' => 'success'
];
$statusLabels = [
    'brouillon' => 'Brouillon', 'en_attente' => 'En attente', 'signature_attendue' => 'Signature attendue',
    'signe' => 'Signé', 'valide' => 'Validé', 'expire' => 'Expiré', 'annule' => 'Annulé',
    'archive' => 'Archivé', 'conforme' => 'Conforme', 'non_conforme' => 'Non conforme',
    'partiellement_conforme' => 'Partiellement conforme', 'en_cours' => 'En cours',
    'actif' => 'Actif', 'inactif' => 'Inactif', 'ouvert' => 'Ouvert', 'clos' => 'Clos',
    'cdi' => 'CDI', 'cdd' => 'CDD', 'freelance' => 'Freelance', 'prestation' => 'Prestation',
    'partenariat' => 'Partenariat', 'confidentialite' => 'Confidentialité', 'licence' => 'Licence',
    'location' => 'Location', 'vente' => 'Vente'
];
$class = $statusClasses[$status] ?? 'secondary';
$label = $statusLabels[$status] ?? ucfirst($status);
@endphp
<span class="badge badge-{{ $class }}">{{ $label }}</span>