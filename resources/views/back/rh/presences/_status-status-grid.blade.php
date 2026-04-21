<div class="row g-4">
    @foreach([
        'present' => 'Présent',
        'absent' => 'Absent',
        'retard' => 'Retard',
        'mission' => 'Mission',
        'teletravail' => 'Télétravail',
        'conge' => 'Congé',
    ] as $key => $label)
        <div class="col-md-4 col-xl-2">
            <div class="content-card h-100">
                <div class="mini-label">{{ $label }}</div>
                <h3 class="stat-number">{{ $statsParStatut[$key] ?? 0 }}</h3>
            </div>
        </div>
    @endforeach
</div>

<style>
    .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
    .stat-number{font-size:30px;font-weight:800;margin:0}
</style>