<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-file-contract"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Documents</span>
                <span class="info-box-number">{{ $totalDocuments ?? 0 }}</span>
                <small>+{{ $documentsMois ?? 0 }} ce mois</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-handshake"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contrats actifs</span>
                <span class="info-box-number">{{ $contratsActifs ?? 0 }}</span>
                <small>{{ $contratsExpirants ?? 0 }} expirent bientôt</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-pen"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Signatures</span>
                <span class="info-box-number">{{ $signaturesEnAttente ?? 0 }}</span>
                <small>en attente</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-gavel"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Litiges</span>
                <span class="info-box-number">{{ $litigesOuverts ?? 0 }}</span>
                <small>ouverts</small>
            </div>
        </div>
    </div>
</div>
