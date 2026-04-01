<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainArea = document.querySelector('.main-area');
        const body = document.body;

        const MOBILE_BREAKPOINT = 992;


        const mobileSearchToggle = document.getElementById('mobileSearchToggle');
        const mobileSearchPanel = document.getElementById('mobileSearchPanel');
        const mobileSearchClose = document.getElementById('mobileSearchClose');
        const themeToggleMobile = document.getElementById('themeToggleMobile');
        const themeToggleMobileIcon = document.getElementById('themeToggleMobileIcon');

        function closeMobileSearch() {
            mobileSearchPanel?.classList.remove('show');
        }

        function openMobileSearch() {
            mobileSearchPanel?.classList.add('show');
        }

        mobileSearchToggle?.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileSearchPanel?.classList.toggle('show');
        });

        mobileSearchClose?.addEventListener('click', function() {
            closeMobileSearch();
        });

        document.addEventListener('click', function(e) {
            if (
                mobileSearchPanel &&
                !mobileSearchPanel.contains(e.target) &&
                !mobileSearchToggle?.contains(e.target)
            ) {
                closeMobileSearch();
            }
        });

        themeToggleMobile?.addEventListener('click', function() {
            const newTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
            localStorage.setItem('eunital-theme', newTheme);
            applyTheme(newTheme);
            closeAllDropdowns();
        });

        function isMobile() {
            return window.innerWidth < MOBILE_BREAKPOINT;
        }

        function openMobileSidebar() {
            sidebar?.classList.add('mobile-open');
            sidebarOverlay?.classList.add('show');
            body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            sidebar?.classList.remove('mobile-open');
            sidebarOverlay?.classList.remove('show');
            body.style.overflow = '';
        }

        function toggleDesktopSidebar() {
            sidebar?.classList.toggle('collapsed');
            mainArea?.classList.toggle('expanded');
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                if (isMobile()) {
                    if (sidebar?.classList.contains('mobile-open')) {
                        closeMobileSidebar();
                    } else {
                        openMobileSidebar();
                    }
                } else {
                    toggleDesktopSidebar();
                }
            });
        }

        if (sidebarCollapseBtn) {
            sidebarCollapseBtn.addEventListener('click', function() {
                if (!isMobile()) {
                    toggleDesktopSidebar();
                }
            });
        }

        sidebarOverlay?.addEventListener('click', function() {
            closeMobileSidebar();
        });

        window.addEventListener('resize', function() {
            if (!isMobile()) {
                closeMobileSidebar();
            }
            window.addEventListener('resize', function() {
                if (!isMobile()) {
                    closeMobileSidebar();
                    closeMobileSearch();
                }
            });
        });

        // DROPDOWNS TOPBAR
        const dropdownButtons = document.querySelectorAll('.topbar-dropdown-toggle');
        const dropdowns = document.querySelectorAll('.topbar-popup');

        function closeAllDropdowns() {
            dropdowns.forEach(dropdown => dropdown.classList.remove('show'));
        }

        dropdownButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();

                const dropdownName = this.dataset.dropdown;
                const target = document.getElementById('dropdown-' + dropdownName);

                if (!target) return;

                const isOpen = target.classList.contains('show');
                closeAllDropdowns();

                if (!isOpen) {
                    target.classList.add('show');
                }
            });
        });

        document.addEventListener('click', function() {
            closeAllDropdowns();
        });

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeAllDropdowns();
                closeMobileSidebar();
            }
        });

        // DARK MODE
        const themeToggle = document.getElementById('themeToggle');
        const themeToggleIcon = document.getElementById('themeToggleIcon');

        function applyTheme(theme) {
            if (theme === 'dark') {
                body.classList.add('dark-mode');
                if (themeToggleIcon) {
                    themeToggleIcon.classList.remove('fa-moon');
                    themeToggleIcon.classList.add('fa-sun');
                }
            } else {
                body.classList.remove('dark-mode');
                if (themeToggleIcon) {
                    themeToggleIcon.classList.remove('fa-sun');
                    themeToggleIcon.classList.add('fa-moon');
                }
            }
            if (themeToggleMobileIcon) {
                if (theme === 'dark') {
                    themeToggleMobileIcon.classList.remove('fa-moon');
                    themeToggleMobileIcon.classList.add('fa-sun');
                } else {
                    themeToggleMobileIcon.classList.remove('fa-sun');
                    themeToggleMobileIcon.classList.add('fa-moon');
                }
            }
        }

        const savedTheme = localStorage.getItem('eunital-theme') || 'light';
        applyTheme(savedTheme);

        themeToggle?.addEventListener('click', function() {
            const newTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
            localStorage.setItem('eunital-theme', newTheme);
            applyTheme(newTheme);
        });
    });
</script>
