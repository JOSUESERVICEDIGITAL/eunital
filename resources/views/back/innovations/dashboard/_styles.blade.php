<style>
    .innovation-hero {
        min-height: 210px;
        border-radius: 28px;
        padding: 32px;
        background:
            radial-gradient(circle at top right, rgba(245, 158, 11, .35), transparent 35%),
            linear-gradient(135deg, #0f172a, #1e293b);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
    }

    .innovation-hero h2 {
        font-size: 34px;
        font-weight: 900;
        margin: 10px 0;
    }

    .innovation-hero p {
        max-width: 760px;
        color: rgba(255,255,255,.78);
        margin: 0;
        font-size: 15px;
        line-height: 1.7;
    }

    .hero-badge {
        display: inline-flex;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.16);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: flex-end;
    }

    .innovation-stat-card {
        background: #fff;
        border-radius: 24px;
        padding: 22px;
        border: 1px solid #eef2f7;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 120px;
    }

    .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .stat-value {
        color: #0f172a;
        font-size: 28px;
        font-weight: 900;
    }

    .stat-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .stat-icon.primary { background:#dbeafe; color:#2563eb; }
    .stat-icon.warning { background:#fef3c7; color:#d97706; }
    .stat-icon.info { background:#cffafe; color:#0891b2; }
    .stat-icon.success { background:#dcfce7; color:#16a34a; }
    .stat-icon.secondary { background:#f1f5f9; color:#475569; }
    .stat-icon.purple { background:#f3e8ff; color:#9333ea; }
    .stat-icon.danger { background:#fee2e2; color:#dc2626; }
    .stat-icon.gold { background:#fef9c3; color:#ca8a04; }

    .section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .section-head h4 {
        font-weight: 900;
        margin-bottom: 4px;
    }

    .section-head p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .hub-table thead th {
        color: #64748b;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: .06em;
        border-bottom: 1px solid #e5e7eb;
    }

    .hub-table td {
        border-bottom: 1px solid #f1f5f9;
        padding-top: 14px;
        padding-bottom: 14px;
    }

    .hub-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .hub-list-item {
        display: flex;
        gap: 14px;
        align-items: center;
        padding: 14px;
        border-radius: 18px;
        border: 1px solid #eef2f7;
        background: #fff;
        text-decoration: none;
        color: #0f172a;
        transition: .2s ease;
    }

    .hub-list-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .hub-list-icon {
        width: 44px;
        height: 44px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hub-list-icon.danger { background:#fee2e2; color:#dc2626; }
    .hub-list-icon.warning { background:#fef3c7; color:#d97706; }
    .hub-list-icon.secondary { background:#f1f5f9; color:#475569; }

    .hub-list-item small {
        color: #64748b;
    }

    .deployment-card {
        border: 1px solid #eef2f7;
        border-radius: 20px;
        padding: 18px;
        background: #f8fafc;
        height: 100%;
    }

    .deployment-card h6 {
        font-weight: 900;
        margin-bottom: 6px;
    }

    .deployment-card p {
        color: #64748b;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .ranking-line {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .ranking-line span {
        color: #475569;
        font-weight: 700;
    }

    .ranking-line strong {
        font-size: 20px;
        color: #0f172a;
    }

    .map-placeholder {
        min-height: 440px;
        border-radius: 24px;
        background:
            radial-gradient(circle at center, rgba(245, 158, 11, .15), transparent 35%),
            linear-gradient(135deg, #f8fafc, #eef2ff);
        border: 1px dashed #cbd5e1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 30px;
    }

    .map-placeholder i {
        font-size: 60px;
        color: #d97706;
        margin-bottom: 18px;
    }

    .map-placeholder h4 {
        font-weight: 900;
    }

    .map-placeholder p {
        max-width: 520px;
        color: #64748b;
    }

    .empty-mini {
        padding: 28px;
        border-radius: 18px;
        background: #f8fafc;
        color: #64748b;
        text-align: center;
        border: 1px dashed #cbd5e1;
    }

    .alert-item {
        border-color: #fee2e2;
    }

    @media (max-width: 768px) {
        .innovation-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .hero-actions {
            justify-content: flex-start;
        }
    }
</style>
