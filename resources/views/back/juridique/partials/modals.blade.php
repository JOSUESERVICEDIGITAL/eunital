<!-- Modal Confirmation Suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet élément ?</p>
                <p class="text-danger">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Signature -->
<div class="modal fade" id="signatureModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Signature électronique</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center border rounded p-3 bg-white">
                    <canvas id="modalSignatureCanvas" width="500" height="200" style="border: 1px solid #ccc; width: 100%; height: auto;"></canvas>
                </div>
                <div class="mt-3 text-center">
                    <button onclick="clearModalSignature()" class="btn btn-secondary">Effacer</button>
                    <button onclick="saveModalSignature()" class="btn btn-success">Valider la signature</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Loading -->
<div class="modal fade" id="loadingModal" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Chargement...</span>
                </div>
                <p class="mt-2">Traitement en cours...</p>
            </div>
        </div>
    </div>
</div>

@push('juridique-scripts')
<script>
    let modalSignaturePad = null;
    
    function showLoading() { $('#loadingModal').modal('show'); }
    function hideLoading() { $('#loadingModal').modal('hide'); }
    
    function initModalSignature() {
        const canvas = document.getElementById('modalSignatureCanvas');
        if (canvas && !modalSignaturePad) {
            modalSignaturePad = new SignaturePad(canvas, { backgroundColor: 'white' });
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            modalSignaturePad.clear();
        }
    }
    
    function clearModalSignature() { if (modalSignaturePad) modalSignaturePad.clear(); }
    
    function saveModalSignature() {
        if (!modalSignaturePad || modalSignaturePad.isEmpty()) { alert('Veuillez signer dans le cadre.'); return; }
        const dataURL = modalSignaturePad.toDataURL();
        $('#signatureModal').modal('hide');
        $('#signatureBase64').val(dataURL);
        $('#signatureForm').submit();
    }
    
    $('#signatureModal').on('shown.bs.modal', initModalSignature);
</script>
@endpush