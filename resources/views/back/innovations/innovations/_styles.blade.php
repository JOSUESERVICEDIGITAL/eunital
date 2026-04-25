<style>
.hub-input {
    height: 48px;
    border-radius: 16px;
}

.mini-stat-card {
    background: #fff;
    border: 1px solid #eef2f7;
    border-radius: 22px;
    padding: 20px;
    min-height: 110px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
}

.mini-stat-card span {
    color: #64748b;
    font-weight: 800;
    font-size: 13px;
}

.mini-stat-card strong {
    font-size: 28px;
    font-weight: 900;
    color: #0f172a;
}

.mini-stat-icon {
    width: 54px;
    height: 54px;
    border-radius: 17px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mini-stat-icon.warning { background:#fef3c7; color:#d97706; }
.mini-stat-icon.info { background:#cffafe; color:#0891b2; }
.mini-stat-icon.purple { background:#f3e8ff; color:#9333ea; }
.mini-stat-icon.success { background:#dcfce7; color:#16a34a; }

.hub-table thead th {
    color: #64748b;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .06em;
}

.hub-table td {
    border-bottom: 1px solid #f1f5f9;
    padding-top: 14px;
    padding-bottom: 14px;
}

.innovation-show-hero {
    min-height: 220px;
    border-radius: 28px;
    padding: 32px;
    background:
        radial-gradient(circle at top right, rgba(245,158,11,.35), transparent 35%),
        linear-gradient(135deg, #0f172a, #1e293b);
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.innovation-show-hero h2 {
    font-weight: 900;
    font-size: 32px;
}

.innovation-show-hero p {
    max-width: 760px;
    color: rgba(255,255,255,.78);
}

.info-line {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    border-bottom: 1px solid #f1f5f9;
    padding: 13px 0;
}

.info-line span {
    color: #64748b;
    font-weight: 700;
}

.info-line strong {
    color: #0f172a;
    text-align: right;
}

.section-head {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 22px;
}

.section-head h4 {
    font-weight: 900;
    margin-bottom: 4px;
}

.section-head p {
    margin: 0;
    color: #64748b;
}

.module-card {
    display: block;
    padding: 18px;
    border-radius: 20px;
    border: 1px solid #eef2f7;
    background: #f8fafc;
    text-decoration: none;
    color: #0f172a;
    font-weight: 900;
    transition: .2s;
}

.module-card:hover {
    background: #fff7ed;
    border-color: #fed7aa;
    color: #d97706;
}

.timeline-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.timeline-item {
    display: flex;
    gap: 14px;
}

.timeline-dot {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    margin-top: 18px;
    flex-shrink: 0;
}

.timeline-card {
    flex: 1;
    border: 1px solid #eef2f7;
    border-radius: 20px;
    padding: 18px;
    background: #fff;
}
</style>
