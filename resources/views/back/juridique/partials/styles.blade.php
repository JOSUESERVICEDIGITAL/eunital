<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

<style>
    .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
    .btn-primary:hover { background: linear-gradient(135deg, #5a67d8 0%, #6b46a0 100%); }
    .status-badge { padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
    .status-active { background-color: #d4edda; color: #155724; }
    .status-inactive { background-color: #f8d7da; color: #721c24; }
    .status-pending { background-color: #fff3cd; color: #856404; }
    .code-display { font-family: monospace; font-size: 1rem; font-weight: bold; background: #f8f9fa; padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid #dee2e6; cursor: pointer; transition: all 0.3s; }
    .code-display:hover { background: #e9ecef; transform: scale(1.02); }
    .avatar-circle { width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; }
    .card-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    .card-header .card-title { color: white; font-weight: 600; }
    .table-hover tbody tr:hover { background-color: rgba(102, 126, 234, 0.05); }
    .badge-purple { background-color: #6f42c1; color: white; }
    .timeline { position: relative; margin: 0; padding: 0; list-style: none; }
    .timeline:before { content: ''; position: absolute; top: 0; bottom: 0; width: 2px; background: #ddd; left: 20px; }
    .timeline > div { position: relative; margin-bottom: 15px; margin-left: 40px; }
    .timeline > div > i { position: absolute; left: -28px; top: 0; background: #fff; border-radius: 50%; padding: 4px; }
    .timeline-item { background: #f8f9fa; border-radius: 4px; padding: 10px; }
</style>