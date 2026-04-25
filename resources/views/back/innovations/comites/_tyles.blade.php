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
    min-height: 105px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
}

.mini-stat-card span {
    color: #64748b;
    font-weight: 800;
    font-size: 13px;
}

.mini-stat-card strong {
    font-size: 26px;
    font-weight: 900;
    color: #0f172a;
}

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

.comite-hero {
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

.comite-hero h2 {
    font-weight: 900;
    font-size: 32px;
}

.comite-hero p {
    max-width: 780px;
    color: rgba(255,255,255,.78);
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

.hub-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.hub-list-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    border: 1px solid #eef2f7;
    border-radius: 20px;
    padding: 16px;
    background: #fff;
}

.hub-list-icon {
    width: 44px;
    height: 44px;
    border-radius: 15px;
    background: #fef3c7;
    color: #d97706;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.hub-list-icon.decision {
    background: #dbeafe;
    color: #2563eb;
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
