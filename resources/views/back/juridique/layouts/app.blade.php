@extends('back.layouts.principal')

@section('title', 'Juridique - ' . ($title ?? 'Dashboard'))
@section('page_title', $page_title ?? 'Chambre juridique')
@section('page_subtitle', $page_subtitle ?? 'Gestion des documents, contrats et conformité')

@section('content')
@include('back.juridique.partials.breadcrumb')
@include('back.juridique.partials.alerts')
@yield('juridique-content')
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@stack('juridique-styles')
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({ title: 'Confirmation', text: 'Êtes-vous sûr ?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6', confirmButtonText: 'Oui, supprimer' }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
        setTimeout(() => { $('.alert').fadeOut('slow'); }, 5000);
    });
</script>
@stack('juridique-scripts')
@endpush