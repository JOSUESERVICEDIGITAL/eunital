<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<style>
    :root {
        --primary: #11b1ad;
        --primary-dark: #0d9488;
        --primary-light: #dff8f6;

        --bg-main: #f8fafc;
        --bg-white: #ffffff;

        --text-dark: #0f172a;
        --text-muted: #64748b;

        --border: #e5e7eb;
        --border-soft: #edf2f7;

        --danger: #ef4444;
        --success: #16a34a;

        --shadow-soft: 0 10px 30px rgba(16, 24, 40, 0.08);

        --radius-xl: 24px;
        --radius-lg: 20px;
        --radius-md: 14px;

        --sidebar-width: 360px;
        --sidebar-collapsed-width: 110px;
        --topbar-height: 88px;

        --sidebar-bg: #ffffff;
        --sidebar-border: #e5e7eb;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        font-family: 'Inter', sans-serif;
        background: var(--bg-main);
        color: var(--text-dark);
    }

    body {
        min-height: 100vh;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .backoffice-wrapper {
        display: flex;
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
    }

    /* =========================
       SIDEBAR
    ========================= */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        border-right: 1px solid var(--sidebar-border);
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1045;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all .3s ease;
        box-shadow: 0 0 30px rgba(15, 23, 42, 0.04);
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-top {
        display: flex;
        flex-direction: column;
        min-height: 0;
        height: 100%;
    }

    .brand {
        min-height: var(--topbar-height);
        padding: 18px;
        border-bottom: 1px solid var(--sidebar-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .brand-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .brand-logo {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: linear-gradient(135deg, #14b8b4, #0f766e);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .brand-text {
        min-width: 0;
    }

    .brand-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.1;
    }

    .brand-subtitle {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 3px;
    }

    .sidebar-collapse-btn {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        border: 1px solid var(--sidebar-border);
        background: #fff;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: all .25s ease;
    }

    .sidebar-collapse-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .sidebar-scroll {
        padding: 16px 14px 18px;
        overflow-y: auto;
        flex: 1;
    }

    .menu-group-title {
        font-size: 12px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 18px 10px 10px;
        padding-bottom: 8px;
        border-bottom: 1px dashed #e2e8f0;
    }

    .menu {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px;
        border-radius: 20px;
        color: var(--text-dark);
        border: 1px solid transparent;
        background: #fff;
        transition: all .25s ease;
    }

    .menu-item:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
        transform: translateY(-1px);
    }

    .menu-item.active {
        background: linear-gradient(135deg, rgba(20, 184, 180, .12), rgba(17, 177, 173, .08));
        border-color: rgba(17, 177, 173, .25);
        box-shadow: var(--shadow-soft);
    }

    .menu-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        flex: 1;
    }

    .menu-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .menu-texts {
        min-width: 0;
    }

    .menu-text {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    .menu-subtext {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
        line-height: 1.3;
    }

    .menu-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .badge-pill {
        min-width: 32px;
        height: 28px;
        padding: 0 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(17, 177, 173, .12);
        color: var(--primary-dark);
    }

  /* =========================
   SUBMENUS / DROPDOWNS
========================= */
.menu-toggle-btn,
.submenu-toggle-btn {
    width: 100%;
    border: none;
    text-align: left;
    background: #fff;
    cursor: pointer;
}

.menu-dropdown-item .menu-item {
    cursor: pointer;
}

.submenu-wrap {
    padding: 6px 0 4px 0;
    display: none;
}

.submenu-wrap.show {
    display: block;
}

.submenu {
    padding: 0 0 0 14px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.submenu-link {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 14px;
    color: #475569;
    background: #f8fafc;
    border: 1px solid var(--border-soft);
    font-size: 13px;
    font-weight: 600;
    transition: all .2s ease;
}

.submenu-link:hover {
    background: #f1f5f9;
    color: #0f172a;
    border-color: #dbe3ec;
}

.submenu-link.active {
    background: #eefaf9;
    color: var(--primary-dark);
    border-color: rgba(17, 177, 173, .25);
    font-weight: 700;
}

.submenu-nested-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.nested-submenu-wrap {
    padding-left: 12px;
    display: none;
}

.nested-submenu-wrap.show {
    display: block;
}

.nested-submenu {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.nested-submenu-link {
    display: block;
    padding: 9px 12px;
    border-radius: 12px;
    color: #64748b;
    background: #ffffff;
    border: 1px dashed #dbe3ec;
    font-size: 12px;
    font-weight: 600;
    transition: .2s ease;
}

.nested-submenu-link:hover {
    color: #0f172a;
    background: #f8fafc;
    border-color: #cfd8e3;
}

.nested-submenu-link.active {
    background: rgba(17, 177, 173, .12);
    color: var(--primary-dark);
    border-color: rgba(17, 177, 173, .25);
    font-weight: 700;
}

.menu-caret,
.submenu-caret {
    transition: transform .25s ease;
    font-size: 12px;
    color: #64748b;
}

.menu-toggle-btn[aria-expanded="true"] .menu-caret,
.submenu-toggle-btn[aria-expanded="true"] .submenu-caret {
    transform: rotate(180deg);
}

    /* =========================
       SIDEBAR BOTTOM
    ========================= */
    .sidebar-bottom {
        border-top: 1px solid var(--sidebar-border);
        padding: 14px;
        background: #fff;
    }

    .profile-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 14px;
        border-radius: 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        margin-bottom: 12px;
    }

    .profile-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .profile-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 2px solid #fff;
    }

    .profile-meta {
        min-width: 0;
    }

    .profile-name {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .profile-role {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
    }

    .profile-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .circle-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .25s ease;
    }

    .circle-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .support-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px;
        border-radius: 20px;
        background: linear-gradient(180deg, #f8fffe, #f1fdfc);
        border: 1px dashed rgba(17, 177, 173, .25);
    }

    .support-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .support-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(17, 177, 173, .12);
        color: var(--primary);
        flex-shrink: 0;
    }

    .support-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .support-text {
        font-size: 12px;
        color: #64748b;
        margin-top: 3px;
    }

    /* =========================
       MAIN AREA
    ========================= */
    .main-area {
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: all .3s ease;
    }

    .main-area.expanded {
        margin-left: var(--sidebar-collapsed-width);
        width: calc(100% - var(--sidebar-collapsed-width));
    }

    .topbar {
        position: fixed;
        top: 0;
        left: var(--sidebar-width);
        right: 0;
        width: auto;
        height: var(--topbar-height);
        background: #fff;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 0 20px;
        z-index: 1000;
        overflow: visible;
    }

    .main-area {
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: all .3s ease;
    }

    .main-area.expanded {
        margin-left: var(--sidebar-collapsed-width);
        width: calc(100% - var(--sidebar-collapsed-width));
    }

    .sidebar.collapsed~.main-area .topbar {
        left: var(--sidebar-collapsed-width);
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
        position: relative;
    }

    .content-area {
        padding: calc(var(--topbar-height) + 24px) 28px 28px;
        flex: 1;
    }

    .sidebar-toggle {
        width: 58px;
        height: 58px;
        border: 1px solid var(--border);
        background: #fff;
        border-radius: 18px;
        font-size: 20px;
        color: #667992;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .search-box {
        flex: 1;
        height: 58px;
        background: #f8fafc;
        border: 1px solid #dfe7ef;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 0 18px;
        min-width: 0;
    }

    .search-box i {
        color: #7d8ca3;
        font-size: 18px;
    }

    .search-box input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 17px;
        color: var(--text-dark);
    }

    .search-shortcut {
        width: 34px;
        height: 34px;
        border: 1px solid #dfe7ef;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7d8ca3;
        font-weight: 700;
        font-size: 15px;
        background: #fff;
    }


    .top-icon {
        position: relative;
        width: 52px;
        height: 52px;
        border: 1px solid var(--border);
        background: white;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #5f7087;
        font-size: 18px;
        cursor: pointer;
        transition: all .25s ease;
    }

    .top-icon:hover {
        color: var(--primary);
        border-color: var(--primary);
    }

    .notif-badge {
        position: absolute;
        top: -4px;
        right: -2px;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 999px;
        background: #ef4444;
        color: white;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }

    .lang-btn {
        font-size: 24px;
    }

    .top-divider {
        width: 1px;
        height: 42px;
        background: var(--border);
        margin: 0 6px;
    }

    .user-summary {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-left: 4px;
    }

    .user-summary img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f0f4f8;
    }

    .user-summary-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .user-summary-name {
        font-size: 16px;
        font-weight: 800;
        color: #1f2c44;
    }

    .user-summary-role {
        font-size: 14px;
        color: #7e8da5;
        font-weight: 500;
    }

    .user-summary-caret {
        color: #93a0b4;
        font-size: 14px;
    }



    .page-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .page-head h1 {
        font-size: 34px;
        font-weight: 800;
        color: #17233b;
        margin-bottom: 10px;
    }

    .page-head p {
        font-size: 16px;
        color: #71829a;
        max-width: 780px;
        line-height: 1.7;
    }

    .page-head-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        height: 50px;
        padding: 0 22px;
        border-radius: 16px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: .25s ease;
    }

    .btn-outline {
        background: #fff;
        border: 1px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover {
        background: #f3fffe;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .content-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 24px;
    }

    /* =========================
       OVERLAY
    ========================= */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .35);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: .3s ease;
    }

    .sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* =========================
       COLLAPSED SIDEBAR
    ========================= */
    .sidebar.collapsed .brand-text,
    .sidebar.collapsed .menu-texts,
    .sidebar.collapsed .menu-group-title,
    .sidebar.collapsed .menu-right,
    .sidebar.collapsed .profile-meta,
    .sidebar.collapsed .support-content,
    .sidebar.collapsed .profile-actions {
        display: none !important;
    }

    .sidebar.collapsed .submenu-wrap,
    .sidebar.collapsed .submenu,
    .sidebar.collapsed .nested-submenu-wrap {
        display: none !important;
    }

    .sidebar.collapsed .brand {
        justify-content: center;
    }

    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding: 12px;
    }

    .sidebar.collapsed .menu-left {
        justify-content: center;
    }

    .sidebar.collapsed .profile-card,
    .sidebar.collapsed .support-box {
        justify-content: center;
    }

    .sidebar.collapsed .profile-left,
    .sidebar.collapsed .support-left {
        justify-content: center;
    }

    .sidebar.collapsed .menu-toggle-btn .menu-right {
        display: none !important;
    }

    .sidebar.collapsed .sidebar-collapse-btn i {
        transform: rotate(180deg);
    }

    /* =========================
       FOCUS STATES
    ========================= */
    .sidebar .menu-item:focus,
    .sidebar .submenu-link:focus,
    .sidebar .nested-submenu-link:focus,
    .sidebar .circle-btn:focus,
    .sidebar .sidebar-collapse-btn:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(17, 177, 173, 0.15);
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
            width: 340px;
        }

        .sidebar.mobile-open {
            transform: translateX(0);
        }

        .main-area,
        .main-area.expanded {
            width: 100% !important;
            margin-left: 0 !important;
        }

        .sidebar-toggle {
            display: inline-flex;
        }

        .sidebar-collapse-btn {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .topbar {
            padding: 0 16px;
        }

        .content-area {
            padding: 18px;
        }

        .page-head h1 {
            font-size: 28px;
        }

        .search-shortcut,
        .top-divider,
        .user-summary-text {
            display: none;
        }

        .topbar-right {
            gap: 8px;
        }

        .top-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
        }
    }

    @media (max-width: 576px) {
        .page-head-actions {
            width: 100%;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .content-card {
            padding: 18px;
        }
    }





    .topbar {
        overflow: visible;
    }

    .topbar-right {
        position: relative;
    }

    .topbar-dropdown {
        position: relative;
    }

    .topbar-dropdown-toggle {
        border: none;
        background: transparent;
        padding: 0;
    }

    .user-summary-btn {
        border: 1px solid var(--border);
        background: #fff;
        border-radius: 18px;
        padding: 8px 12px 8px 8px;
        min-height: 56px;
        transition: all .25s ease;
    }

    .user-summary-btn:hover {
        border-color: var(--primary);
    }

    .topbar-popup {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 280px;
        background: #fff;
        border: 1px solid #dbe3ec;
        border-radius: 20px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.14);
        opacity: 0;
        visibility: hidden;
        transform: translateY(8px);
        transition: all .22s ease;
        z-index: 1100;
        overflow: hidden;
    }

    .topbar-popup.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .topbar-popup-lg {
        width: 290px;
    }

    .topbar-popup-xl {
        width: 370px;
    }

    .topbar-popup-profile {
        width: 280px;
    }

    .topbar-popup-header {
        padding: 16px 18px;
        border-bottom: 1px solid #e8eef5;
        background: #fff;
    }

    .topbar-popup-header h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #1f2937;
    }

    .topbar-popup-header small {
        color: #7c8ca3;
        font-size: 13px;
    }

    .topbar-popup-body {
        padding: 16px;
    }

    .topbar-popup-scroll {
        max-height: 380px;
        overflow-y: auto;
    }

    .topbar-popup-footer {
        padding: 14px 18px;
        border-top: 1px solid #e8eef5;
        text-align: center;
        background: #fff;
    }

    .popup-footer-link,
    .popup-link-action {
        color: #0ea5a4;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
    }

    .popup-list-item {
        width: 100%;
        border: none;
        background: #fff;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: background .2s ease;
        font-size: 15px;
        color: #1f2937;
    }

    .popup-list-item:hover {
        background: #f8fafc;
    }

    .popup-list-item.active {
        background: #eaf6f5;
        color: #0f766e;
    }

    .popup-list-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .popup-flag {
        font-size: 22px;
        line-height: 1;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .quick-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 10px 4px;
        border-radius: 16px;
        transition: background .2s ease;
        text-decoration: none;
        color: #1f2937;
        font-size: 14px;
        font-weight: 600;
    }

    .quick-item:hover {
        background: #f8fafc;
    }

    .quick-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .message-item,
    .notif-item {
        position: relative;
        display: flex;
        gap: 14px;
        padding: 16px 18px;
        border-bottom: 1px solid #edf2f7;
        text-decoration: none;
        color: inherit;
        transition: background .2s ease;
    }

    .message-item:hover,
    .notif-item:hover {
        background: #f8fafc;
    }

    .message-item img,
    .notif-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .message-content,
    .notif-content {
        min-width: 0;
        flex: 1;
    }

    .message-name,
    .notif-title {
        font-size: 15px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .message-text,
    .notif-text {
        font-size: 14px;
        color: #64748b;
        line-height: 1.45;
        margin-bottom: 6px;
    }

    .message-time,
    .notif-time {
        font-size: 12px;
        color: #94a3b8;
    }

    .message-dot,
    .notif-dot {
        position: absolute;
        left: 8px;
        top: 22px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #0ea5a4;
    }

    .notif-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .profile-popup-head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        border-bottom: 1px solid #e8eef5;
    }

    .profile-popup-head img {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-popup-name {
        font-size: 18px;
        font-weight: 800;
        color: #1f2937;
    }

    .profile-popup-email {
        font-size: 14px;
        color: #7c8ca3;
        margin-top: 2px;
    }

    .profile-popup-body {
        padding: 12px;
    }

    .profile-popup-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 10px;
        border-radius: 14px;
        text-decoration: none;
        color: #1f2937;
        font-weight: 600;
        transition: background .2s ease;
    }

    .profile-popup-link:hover {
        background: #f8fafc;
    }

    .profile-popup-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-popup-footer {
        padding: 12px 18px 18px;
        border-top: 1px solid #e8eef5;
    }

    .profile-signout-btn {
        width: 100%;
        border: none;
        background: #fff;
        color: #ef4444;
        font-weight: 800;
        font-size: 18px;
        padding: 10px 12px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background .2s ease;
    }

    .profile-signout-btn:hover {
        background: #fef2f2;
    }

    .dark-mode {
        --bg-main: #0f172a;
        --bg-white: #111827;
        --text-dark: #f8fafc;
        --text-muted: #94a3b8;
        --border: #243041;
        --border-soft: #243041;
        --sidebar-bg: #111827;
        --sidebar-border: #243041;
    }

    .dark-mode body,
    body.dark-mode {
        background: #0f172a;
        color: #f8fafc;
    }

    body.dark-mode .topbar,
    body.dark-mode .sidebar,
    body.dark-mode .content-card,
    body.dark-mode .topbar-popup,
    body.dark-mode .search-box,
    body.dark-mode .user-summary-btn,
    body.dark-mode .profile-card,
    body.dark-mode .support-box,
    body.dark-mode .menu-item,
    body.dark-mode .submenu-link,
    body.dark-mode .nested-submenu-link {
        background: #111827 !important;
        color: #f8fafc !important;
        border-color: #243041 !important;
    }

    body.dark-mode .page-head h1,
    body.dark-mode .menu-text,
    body.dark-mode .profile-popup-name,
    body.dark-mode .message-name,
    body.dark-mode .notif-title,
    body.dark-mode .brand-title {
        color: #f8fafc !important;
    }

    body.dark-mode .menu-subtext,
    body.dark-mode .profile-role,
    body.dark-mode .support-text,
    body.dark-mode .page-head p,
    body.dark-mode .profile-popup-email,
    body.dark-mode .message-text,
    body.dark-mode .notif-text,
    body.dark-mode .message-time,
    body.dark-mode .notif-time {
        color: #94a3b8 !important;
    }

    body.dark-mode .popup-list-item,
    body.dark-mode .profile-signout-btn {
        background: #111827;
        color: #f8fafc;
    }

    body.dark-mode .popup-list-item:hover,
    body.dark-mode .profile-popup-link:hover,
    body.dark-mode .quick-item:hover,
    body.dark-mode .message-item:hover,
    body.dark-mode .notif-item:hover,
    body.dark-mode .profile-signout-btn:hover {
        background: #1f2937 !important;
    }

    @media (max-width: 768px) {

        .topbar-popup,
        .topbar-popup-lg,
        .topbar-popup-xl,
        .topbar-popup-profile {
            width: min(92vw, 360px);
            right: 0;
        }

        .user-summary-btn {
            padding-right: 10px;
        }

        .quick-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }





    .topbar-right {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
        position: relative;
    }

    .topbar-actions-group {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 8px;
        background: #ffffff;
        border: 1px solid #dbe3ec;
        border-radius: 22px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
        position: relative;
        flex-shrink: 0;
    }

    .topbar-actions-group .topbar-dropdown {
        position: relative;
    }

    .topbar-actions-group .top-icon {
        width: 48px;
        height: 48px;
        border: 1px solid #dbe3ec;
        background: #fff;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 18px;
        position: relative;
        transition: all .25s ease;
    }

    .topbar-actions-group .top-icon:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #f8fffe;
    }

    .topbar-actions-group .lang-btn {
        font-size: 22px;
    }

    .topbar-actions-group .notif-badge {
        position: absolute;
        top: -5px;
        right: -3px;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 999px;
        background: #ef4444;
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    .top-divider {
        width: 1px;
        height: 42px;
        background: #dbe3ec;
        margin: 0 2px;
    }

    .user-summary-btn {
        border: 1px solid #dbe3ec;
        background: #fff;
        border-radius: 18px;
        padding: 8px 12px 8px 8px;
        min-height: 56px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all .25s ease;
        max-width: 260px;
    }

    .user-summary-btn:hover {
        border-color: var(--primary);
        background: #f8fffe;
    }

    .topbar-popup {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 280px;
        background: #fff;
        border: 1px solid #dbe3ec;
        border-radius: 20px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.14);
        opacity: 0;
        visibility: hidden;
        transform: translateY(8px);
        transition: all .22s ease;
        z-index: 1100;
        overflow: hidden;
    }

    .topbar-popup.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .topbar-actions-group {
            gap: 4px;
            padding: 5px 6px;
            border-radius: 18px;
        }

        .topbar-actions-group .top-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            font-size: 16px;
        }

        .topbar-actions-group .lang-btn {
            font-size: 20px;
        }

        .user-summary-btn {
            padding-right: 10px;
        }
    }



    .mobile-search-toggle,
    .mobile-only {
        display: none;
    }

    .mobile-search-panel {
        display: none;
    }

    @media (max-width: 768px) {
        .search-box {
            display: none;
        }

        .mobile-search-toggle {
            width: 44px;
            height: 44px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 16px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .mobile-only {
            display: block;
        }

        .topbar-actions-group {
            display: none;
        }

        .top-divider {
            display: none;
        }

        .user-summary-text,
        .user-summary-caret {
            display: none;
        }

        .user-summary-btn {
            min-height: 44px;
            padding: 4px;
            border-radius: 14px;
        }

        .user-summary-btn img {
            width: 36px;
            height: 36px;
        }

        .mobile-search-panel {
            display: none;
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            right: 0;
            z-index: 1001;
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 10px 12px;
        }

        .mobile-search-panel.show {
            display: block;
        }

        .mobile-search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            height: 48px;
            background: #f8fafc;
            border: 1px solid #dfe7ef;
            border-radius: 14px;
            padding: 0 12px;
        }

        .mobile-search-box i {
            color: #7d8ca3;
        }

        .mobile-search-box input {
            flex: 1;
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
            color: var(--text-dark);
        }

        .mobile-search-box button {
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 16px;
            cursor: pointer;
        }

        .topbar-popup-mobile-actions {
            width: min(88vw, 280px);
            right: 0;
        }
    }



    #statutSelect.en_attente {
    color: #ffc107; /* jaune */
}

#statutSelect.valide {
    color: #198754; /* vert */
}

#statutSelect.termine {
    color: #0d6efd; /* bleu */
}

#statutSelect.abandonne {
    color: #dc3545; /* rouge */
}
</style>