<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

        $(document).on('click', '.btn-delete-record', function () {
            let action = $(this).data('action');
            $('#confirmDeleteForm').attr('action', action);
            $('#confirmDeleteModal').modal('show');
        });
    });
</script>

@stack('scripts')
