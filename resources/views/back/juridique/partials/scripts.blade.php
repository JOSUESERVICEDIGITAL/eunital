<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

<script>
    $(document).ready(function() {
        // Tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Auto-hide alerts
        setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
        
        // DataTables
        if ($('.datatable').length) {
            $('.datatable').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json' },
                pageLength: 25
            });
        }
        
        // Datepicker
        if ($('.datepicker').length) {
            $('.datepicker').attr('type', 'date');
        }
    });
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        Swal.fire({ icon: 'success', title: 'Copié !', text: 'Texte copié dans le presse-papier', timer: 2000, showConfirmButton: false });
    }
    
    function exportToExcel(tableId, filename) {
        const table = document.getElementById(tableId);
        const html = table.outerHTML;
        const url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
        const link = document.createElement('a');
        link.href = url;
        link.download = filename + '_' + new Date().toISOString().slice(0,19) + '.xls';
        link.click();
    }
</script>