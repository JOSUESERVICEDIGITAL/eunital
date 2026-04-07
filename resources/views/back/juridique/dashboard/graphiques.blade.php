<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Documents par mois</h3>
            </div>
            <div class="card-body">
                <canvas id="documentsMoisChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contrats par type</h3>
            </div>
            <div class="card-body">
                <canvas id="contratsTypeChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var ctx1 = document.getElementById('documentsMoisChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: {!! json_encode($documentsParMois->keys()) !!},
            datasets: [{
                label: 'Documents',
                data: {!! json_encode($documentsParMois->values()) !!},
                backgroundColor: '#007bff'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    var ctx2 = document.getElementById('contratsTypeChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: {!! json_encode($contratsParType->keys()) !!},
            datasets: [{
                data: {!! json_encode($contratsParType->values()) !!},
                backgroundColor: ['#28a745', '#ffc107', '#17a2b8', '#6f42c1', '#fd7e14']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
