<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info">
                <i class="fas fa-chart-line"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Progression globale</span>
                <span class="info-box-number">{{ round($progressionGlobale['moyenne'] ?? 0, 1) }}%</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success">
                <i class="fas fa-check-circle"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Taux de complétion</span>
                <span class="info-box-number">{{ $progressionGlobale['pourcentage_termines'] ?? 0 }}%</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning">
                <i class="fas fa-clock"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Taux de présence</span>
                <span class="info-box-number">{{ $presences['taux_presence'] ?? 0 }}%</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-star"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Note moyenne</span>
                <span class="info-box-number">{{ round($noteMoyenne ?? 0, 1) }}/20</span>
            </div>
        </div>
    </div>
</div>