<style>
    .mini-label{
        font-size:13px;
        color:#64748b;
        font-weight:700;
        margin-bottom:8px;
    }

    .stat-number{
        font-size:32px;
        font-weight:800;
        margin:0;
    }

    .stat-icon{
        width:58px;
        height:58px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
    }

    .custom-input{
        height:48px;
        border-radius:16px;
    }

    .table-head-custom{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:16px;
        flex-wrap:wrap;
    }

    .custom-table thead th{
        font-size:13px;
        text-transform:uppercase;
        letter-spacing:.5px;
        color:#64748b;
        border-bottom:1px solid #e5e7eb;
    }

    .custom-table tbody td{
        border-bottom:1px solid #f1f5f9;
    }

    .table-avatar{
        width:48px;
        height:48px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:18px;
    }

    .empty-state{
        padding:20px;
        text-align:center;
    }

    .empty-state-icon{
        font-size:42px;
        color:#94a3b8;
    }

    .hero-card{
        background:linear-gradient(135deg, rgba(17,177,173,.06), rgba(59,130,246,.04));
    }

    .hero-icon{
        width:86px;
        height:86px;
        border-radius:24px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:30px;
    }

    .info-list{
        display:flex;
        flex-direction:column;
        gap:14px;
    }

    .info-row{
        display:flex;
        justify-content:space-between;
        gap:16px;
        padding-bottom:12px;
        border-bottom:1px solid #f1f5f9;
    }

    .info-label{
        font-size:14px;
        color:#64748b;
        font-weight:700;
    }

    .info-value{
        font-size:14px;
        color:#0f172a;
        text-align:right;
        font-weight:600;
    }

    .note-box{
        background:#f8fafc;
        border:1px solid #e5e7eb;
        border-radius:18px;
        padding:18px;
        line-height:1.7;
        color:#334155;
    }

    .timeline-item{
        display:flex;
        gap:16px;
        position:relative;
        padding-bottom:18px;
    }

    .timeline-item:not(:last-child)::after{
        content:'';
        position:absolute;
        left:9px;
        top:24px;
        width:2px;
        height:calc(100% - 8px);
        background:#e5e7eb;
    }

    .timeline-dot{
        width:20px;
        height:20px;
        border-radius:50%;
        flex-shrink:0;
        margin-top:12px;
    }

    .timeline-card{
        flex:1;
        border:1px solid #eef2f7;
        border-radius:18px;
        padding:16px;
        background:#fff;
    }
</style>