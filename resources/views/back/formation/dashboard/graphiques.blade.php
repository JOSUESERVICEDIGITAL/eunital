<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-trophy mr-2"></i>
                    Cours les plus populaires
                </h3>
            </div>
            <div class="card-body">
                <canvas id="popularCoursChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Présences par cours
                </h3>
            </div>
            <div class="card-body">
                <canvas id="presencesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Graphique des cours populaires
        var ctx3 = document.getElementById('popularCoursChart').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: {!! json_encode($coursPopulaires->pluck('titre')) !!},
                datasets: [{
                    label: "Nombre d'étudiants",
                    data: {!! json_encode($coursPopulaires->pluck('utilisateurs_count')) !!},
                    backgroundColor: '#007bff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
        
        // Graphique des présences
        var ctx4 = document.getElementById('presencesChart').getContext('2d');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: {!! json_encode($presencesParCours->pluck('cour_titre')) !!},
                datasets: [{
                    label: 'Taux de présence (%)',
                    data: {!! json_encode($presencesParCours->pluck('taux_presence')) !!},
                    backgroundColor: '#28a745'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    });
</script>
@endpush